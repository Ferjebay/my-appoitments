<?php

use Illuminate\Database\Seeder;
use App\WorkDay;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 7; $i++) { 
        	WorkDay::create([
        		'day' => $i,
		        'active' => ($i==5),
		        'morning_start' => ($i==5 ? '07:00:00' : '05:00:00'),
		        'morning_end' => ($i==5 ? '09:30:00' : '05:00:00'),
		        'afternoon_start' => ($i==5 ? '13:00:00' : '13:00:00'),
		        'afternoon_end' => ($i==5 ? '18:00:00' : '13:00:00'),
		        'user_id' => 2
        	]);
        }
    }
}
