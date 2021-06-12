<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Juan Saa A',
	        'email' => 'juan@gmail.com',
	        'address' => 'La ventura',
	        'phone' => '09397766717',
	        'dni' => '1207486638',
	        'role' => 'admin',	        
	        'password' => bcrypt('123456')
    	]);
        User::create([
            'name' => 'Byron Francisco Saa A.',
            'email' => 'doctor@gmail.com',
            'address' => 'La ventura',
            'phone' => '09397766717',
            'dni' => '1207486638',
            'role' => 'doctor',          
            'password' => bcrypt('123456')
        ]);
        User::create([
            'name' => 'Juan Jesus Saa A.',
            'email' => 'patient@gmail.com',
            'address' => 'La ventura',
            'phone' => '09397766717',
            'dni' => '1207486638',
            'role' => 'patient',          
            'password' => bcrypt('123456')
        ]);
        factory(User::class, 50)->states('patient')->create();
    }
}
