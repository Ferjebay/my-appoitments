<?php

use Illuminate\Database\Seeder;
use App\Appointment;

class AppointmentsTableSeeder extends Seeder
{  
    public function run()
    {
        factory(Appointment::class, 300)->create();
    }
}
