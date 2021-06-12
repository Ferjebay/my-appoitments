<?php

Route::get('/', function () {
    return redirect('/login');//return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
	Route::resource('/specialties', 'Admin\SpecialtyController');
	Route::resource('/doctors', 'Admin\DoctorController');
	Route::resource('/patients', 'Admin\PatientController');    
	Route::get('/charts/appointments/line', 'Admin\ChartController@appointments');
	Route::get('/charts/doctors/bar', 'Admin\ChartController@doctors');
	Route::get('/charts/doctors/column/data', 'Admin\ChartController@doctorsJson');
});

Route::middleware(['auth', 'doctor'])->namespace('doctor')->group(function () {
	Route::get('/schedule', 'ScheduleController@edit');	 
	Route::post('/schedule', 'ScheduleController@store');	 
});

Route::middleware(['auth'])->group(function () {
	Route::get('/appointments/create', 'AppointmentController@create');	 
	Route::post('/appointments', 'AppointmentController@store');	 
	
	Route::get('/appointments', 'AppointmentController@index');	 
	Route::get('/appointments/{appointment}', 'AppointmentController@show');	 
	Route::get('/appointments/{appointment}/cancel', 'AppointmentController@showCancelForm');	 
	Route::post('/appointments/{appointment}/cancel', 'AppointmentController@postCancel');	 
	Route::post('/appointments/{appointment}/confirm', 'AppointmentController@postConfirm');	 
	
	//JSON
	Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors');	 
	Route::get('/schedule/hours', 'Api\ScheduleController@hours');	 
});