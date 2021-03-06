<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Appointment::class, function (Faker $faker) {
	$doctorIds = User::doctors()->pluck('id');
	$patientIds = User::patients()->pluck('id');

	$scheduled = $faker->dateTimeBetween('-1 years', 'now');
	$scheduled_date = $scheduled->format('Y-m-d');
	$scheduled_time = $scheduled->format('H:i:s');

	$types = ['Consulta', 'Examen', 'Operacion'];
	$statuses = ['Atendida', 'Cancelada'];

    return [
        'description'	 => $faker->sentence(7),
        'specialty_id' 	 => $faker->numberBetween(1, 3),
        'doctor_id' 	 => $faker->randomElement($doctorIds),
        'patient_id' 	 => $faker->randomElement($patientIds),
        'scheduled_date' => $scheduled_date,
        'scheduled_time' => $scheduled_time,
        'type' 			 => $faker->randomElement($types),
        'status' 		 => $faker->randomElement($statuses),
    ];
});
