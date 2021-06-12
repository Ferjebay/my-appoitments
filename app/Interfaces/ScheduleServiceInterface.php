<?php 

namespace App\Interfaces;
use Carbon\Carbon;	

interface ScheduleServiceInterface{

	public function isAvailableInterval($date, $doctor_id, Carbon $start);
	public function getAvailableIntervals($date, $doctor_id);

}
	
?>