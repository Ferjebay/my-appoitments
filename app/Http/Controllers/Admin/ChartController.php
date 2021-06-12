<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use DB;
use App\User;
use Carbon\Carbon;

class ChartController extends Controller{

	public function appointments(){
		$montlyCounts = Appointment::select(
					DB::raw('MONTH(created_at) as month'),
					DB::raw('COUNT(1) as count'))
						->groupBy('month')->get()->toArray();			
		$counts = array_fill(0, 12, 0); 
		foreach ($montlyCounts as $montlyCount) {
			$index = $montlyCount['month']-1;
			$counts[$index] = $montlyCount['count'];
		}		
		return view('charts.appointments', compact('counts'));
	}

	public function doctors(){
		$now = Carbon::now();
		$end = $now->format('d-m-Y');
		$start = $now->subYear()->format('d-m-Y');		
		return view('charts.doctors', compact('start', 'end'));
	}

	public function doctorsJson(Request $request){
		$start = date('Y-m-d', strtotime($request->start));		
		$end   = date('Y-m-d', strtotime($request->end));		
		$doctors = User::doctors()
			->select('name')
			->withCount([
				'attendedAppointments' => function($query) use($start, $end){
					$query->whereBetween('scheduled_date', [$start, $end]);
				}, 
				'cancelledAppointments' => function($query) use($start, $end){
					$query->whereBetween('scheduled_date', [$start, $end]);
				}
			])
			->orderBy('attended_appointments_count', 'desc')
			->take(5)->get();
		$data = [];
		$data['categories'] = $doctors->pluck('name');
		$series = [];
		//Atendidas
		$series1['name'] = 'Citas Atendidas';
		$series1['data'] = $doctors->pluck('attended_appointments_count'); //Atendidas
		//Canceladas
		$series2['name'] = 'Citas Canceladas';
		$series2['data'] = $doctors->pluck('cancelled_appointments_count'); //Canceladas
		$series[] = $series1;
		$series[] = $series2;
		$data['series'] = $series;
		return $data;
	}
}
