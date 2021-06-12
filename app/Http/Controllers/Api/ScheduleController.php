<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;

class ScheduleController extends Controller{
    
	public function hours(Request $request, ScheduleServiceInterface $scheduleService){
		$request->validate([
			'date' => 'required|date_format:"Y-m-d"',
			'doctor_id' => 'required|exists:users,id'
		]);
		$date = $request->date;
		$doctorId = $request->doctor_id;
		return $scheduleService->getAvailableIntervals($date, $doctorId);
	}

	private function getIntervals($start, $end){
		$start = new Carbon($start);
		$end   = new Carbon($end);
		$intervals = [];
		while($start < $end){
			$interval = [];
			$interval['start'] = $start->format('g:i A');
			$start->addMinutes(30);
			$interval['end'] = $start->format('g:i A');
			$intervals[] = $interval;
		}
		return $intervals;
	}

}
