<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
	//Specialty
	Route::resource('/specialties', 'Admin\SpecialtyController');
	//Doctors
	Route::resource('/doctors', 'Admin\DoctorController');
	//Patients
	Route::resource('/patients', 'Admin\PatientController');    
});

Route::middleware(['auth', 'doctor'])->namespace('doctor')->group(function () {
	Route::get('/schedule', 'ScheduleController@edit');	 
	Route::post('/schedule', 'ScheduleController@store');	 
});
