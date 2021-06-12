<?php

use Illuminate\Database\Seeder;
use App\Specialty;
use App\User;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
        	'Oftomologia',
        	'Pediatria',
        	'Neurologia'
        ];
        foreach ($specialties as $specialty) {
        	$specialty = Specialty::create([
        		'name' => $specialty
        	]);

        	$specialty->users()->saveMany(
        		factory(User::class, 3)->states('doctor')->make()
        	);
        }
    }
}
