<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Author: Valentine Mwangi
| © Cimplicity Apps. All Rights Reserved.
| 2016
|
*/


Route::get('/',                           ['uses' => 'Home\HomeController@getHome','as' => 'home', 'middleware'=> array('guest')]);
Route::post('/',                   		  ['uses' => 'Auth\AuthController@postLogin', 'middleware'=> array('guest')]);
Route::get('/signout',                     ['uses' => 'Auth\AuthController@getLogout','as' => 'log-out']);
Route::get('/home-redirect',              ['uses' => 'Auth\AuthController@homeCheck','as' => 'home-redirect']);
Route::group(array('before' => 'auth', 'after' => 'no-cache'), function()
{


Route::get('/doctor',                     ['uses' => 'Doctor\DoctorController@getDashboard','as' => 'doctor-home', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-appointments',        ['uses' => 'Doctor\DoctorController@getDoctorAppointments','as' => 'doctor-appointments', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-consultations',       ['uses' => 'Doctor\DoctorController@getDoctorConsultations','as' => 'doctor-consultations', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-calendar',            ['uses' => 'Doctor\DoctorController@getDoctorCalendar','as' => 'doctor-calendar', 'middleware'=> 'auth:doctor']);

Route::get('/reception',                  ['uses' => 'Reception\ReceptionController@getHome','as' => 'reception-home', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients',         ['uses' => 'Reception\ReceptionController@getPatients','as' => 'reception-patients', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients-results', ['uses' => 'Reception\ReceptionController@getPatientsResults','as' => 'reception-patients-results', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-registration',     ['uses' => 'Reception\ReceptionController@getRegistration','as' => 'reception-registration', 'middleware'=> 'auth:receptionist']);
Route::post('/reception-registration',    ['uses' => 'Medical\PatientController@registerPatient',                'as' => 'register-patient']);
Route::post('/search',                    ['uses' => 'Reception\ReceptionController@searchPatient',                       'as' => 'search']);

Route::get('/reception-calendar',         ['uses' => 'Reception\ReceptionController@getCalendar','as' => 'reception-calendar', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-appointments',     ['uses' => 'Reception\AppointmentsController@getAppointments','as' => 'reception-appointments', 'middleware'=> 'auth:receptionist']);
Route::post('/create-appointment',        ['uses' => 'Reception\AppointmentsController@createAppointment',                'as' => 'create-appointment']);
Route::post('/search-appointment',        ['uses' => 'Reception\ReceptionController@searchAppointment',                       'as' => 'search-appointment']);
Route::delete('/reception-appointments/{id}','Reception\AppointmentsController@cancelAppointment');

Route::get('/accounts',           ['uses' => 'Accounts\AccountsController@getHome','as' => 'accounts-home']);
Route::get('/accounts-payments',  ['uses' => 'Accounts\AccountsController@getPayments','as' => 'accounts-payments']);
Route::get('/accounts-services',  ['uses' => 'Accounts\AccountsController@getServices','as' => 'accounts-services']);
Route::get('/accounts-insurance', ['uses' => 'Accounts\AccountsController@getInsurance','as' => 'accounts-insurance']);
Route::get('/accounts-reports',   ['uses' => 'Accounts\AccountsController@getReports','as' => 'accounts-reports']);

Route::get('/lab',                ['uses' => 'Lab\LabController@getHome','as' => 'lab-home']);
Route::get('/lab-records',        ['uses' => 'Lab\LabController@getRecords','as' => 'lab-records']);
Route::get('/lab-past-records',   ['uses' => 'Lab\LabController@getPastRecords','as' => 'past-records']);

Route::get('/medical-profile',    ['uses' => 'Medical\MedicalController@getHome','as' => 'medical-profile', 'middleware'=> 'auth:doctor']);

});


