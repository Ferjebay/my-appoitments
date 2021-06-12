<?php 

namespace App\Services;
use App\WorkDay;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use App\Appointment;

class ScheduleService implements ScheduleServiceInterface{

	public function isAvailableInterval($date, $doctor_id, Carbon $start){		
		$exists = Appointment::where('doctor_id', $doctor_id)
					->where('scheduled_date', $date)
					->where('scheduled_time', $start->format('H:i:s'))->exists();
		return !$exists;
	}

	private function getDayFromDate($date){
		$dateCarbon = new Carbon($date);
		$i = $dateCarbon->dayOfWeek;
		$day = ($i == 0) ? 6 : $i -=1;
		return $day;
	}

	public function getAvailableIntervals($date, $doctor_id){
		$workDays = WorkDay::where('active', true)->where('day', $this->getDayFromDate($date))
				->where('user_id', $doctor_id)->first([
					'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end'
				]);		

		if(!$workDays){
			return [];
		}
		
		$morningIntervals = $this->getIntervals(
				$workDays->morning_start, $workDays->morning_end, $date, $doctor_id);

		$afternoonIntervals = $this->getIntervals(
				$workDays->afternoon_start, $workDays->afternoon_end, $date, $doctor_id);
		$data = [];
		$data['morning'] = $morningIntervals;
		$data['afternoon'] = $afternoonIntervals;
		return $data;
	}

	private function getIntervals($start, $end, $date, $doctor_id){
		$start = new Carbon($start);
		$end   = new Carbon($end);
		$intervals = [];
		while($start < $end){
			$interval = [];
			$interval['start'] = $start->format('g:i A');
			$available = $this->isAvailableInterval($date, $doctor_id, $start);			
			$start->addMinutes(30);
			$interval['end'] = $start->format('g:i A');
			
			if($available){
				$intervals[] = $interval;
			}
		}
		return $intervals;
	}
}

?>