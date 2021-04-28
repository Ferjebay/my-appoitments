<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
        $this->call(UsersTableSeeder::class);
    }
}
