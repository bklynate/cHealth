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
Route::get('/doctor-history',       ['uses' => 'Doctor\DoctorController@getDoctorHistory','as' => 'doctor-consultations', 'middleware'=> 'auth:doctor']);
Route::get('/doctor-calendar',            ['uses' => 'Doctor\DoctorController@getDoctorCalendar','as' => 'doctor-calendar', 'middleware'=> 'auth:doctor']);
Route::put('/appointment/{id}',           ['uses' => 'Doctor\DoctorController@consultPatient', 'as' => 'consultPatient']);
Route::delete('/doctor-appointments/{id}','Doctor\DoctorController@cancelAppointment');

Route::get('/reception',                  ['uses' => 'Reception\ReceptionController@getHome','as' => 'reception-home', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients',         ['uses' => 'Reception\ReceptionController@getPatients','as' => 'reception-patients', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-patients-results', ['uses' => 'Reception\ReceptionController@getPatientsResults','as' => 'reception-patients-results', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-registration',     ['uses' => 'Reception\ReceptionController@getRegistration','as' => 'reception-registration', 'middleware'=> 'auth:receptionist']);
Route::post('/reception-registration',    ['uses' => 'Medical\PatientController@registerPatient',                'as' => 'register-patient']);
Route::post('/search',                    ['uses' => 'Reception\ReceptionController@searchPatient',                       'as' => 'search']);
Route::put('/appointments-update/{id}',   ['uses' => 'Reception\AppointmentsController@updateAppointment',   'as' => 'appointments-update']);

Route::get('/reception-doctors',         ['uses' => 'Reception\ReceptionController@getDoctors','as' => 'reception-doctors', 'middleware'=> 'auth:receptionist']);
Route::get('/reception-appointments',     ['uses' => 'Reception\AppointmentsController@getAppointments','as' => 'reception-appointments', 'middleware'=> 'auth:receptionist']);
Route::post('/create-appointment',        ['uses' => 'Reception\AppointmentsController@createAppointment',                'as' => 'create-appointment']);
Route::post('/search-appointment',        ['uses' => 'Reception\ReceptionController@searchAppointment',                       'as' => 'search-appointment']);
Route::delete('/reception-appointments/{id}','Reception\AppointmentsController@cancelAppointment');


Route::get('/accounts',                       ['uses' => 'Accounts\AccountsController@getHome','as' => 'accounts-home']);
Route::get('/accounts-payments',              ['uses' => 'Accounts\AccountsController@getPayments','as' => 'accounts-payments']);
Route::get('/accounts-services',              ['uses' => 'Accounts\ServicesController@getServices','as' => 'accounts-services']);
Route::get('/accounts-insurance',             ['uses' => 'Accounts\InsuranceController@getInsurance','as' => 'accounts-insurance']);
Route::get('/accounts-reports',               ['uses' => 'Accounts\AccountsController@getReports','as' => 'accounts-reports']);
Route::post('/accounts-services',             ['uses' => 'Accounts\ServicesController@addService']);
Route::delete('/accounts-services/{id}',                 'Accounts\ServicesController@deleteService');
Route::put('/accounts-services/{id}',         ['uses' => 'Accounts\ServicesController@updateService',   'as' => 'update-service']);
Route::post('/search-services',               ['uses' => 'Accounts\ServicesController@searchService',                       'as' => 'search-services']);
Route::put('/confirm-payment/{id}',           ['uses' => 'Accounts\AccountsController@confirmPayment', 'as' => 'confirm-payment']);
Route::post('/search-payment',                ['uses' => 'Accounts\AccountsController@searchPayment', 'as' => 'search-payment']);
Route::put('/payment/{id}',                   ['uses' => 'Accounts\AccountsController@updatePayment',   'as' => 'update-payment']);
Route::post('/create-insurance',              ['uses' => 'Accounts\InsuranceController@createInsurance']);
Route::delete('/delete-insurance/{id}',        'Accounts\InsuranceController@deleteInsurance');
Route::put('/insurance-payment/{id}',        ['uses' => 'Accounts\InsuranceController@updateInsurance',   'as' => 'update-insurance']);
Route::post('/search-insurances',             ['uses' => 'Accounts\InsuranceController@searchInsurance', 'as' => 'search-insurances']);

Route::get('/pharmacy',                       ['uses' => 'Pharmacy\DispensationController@getHome','as' => 'pharmacy-home']);
Route::get('/dispensations',                  ['uses' => 'Pharmacy\DispensationController@getDispensation','as' => 'pharmacy-dispensations']);
Route::get('/inventory',                      ['uses' => 'Pharmacy\InventoryController@getInventory','as' => 'pharmacy-inventory']);
Route::get('/refills',                         ['uses' => 'Pharmacy\RefillController@getRefill','as' => 'pharmacy-refills']);
Route::post('/refill-new',                    ['uses' => 'Pharmacy\RefillController@refillNew']);
Route::put('/update-dispensations/{id}',        ['uses' => 'Pharmacy\DispensationController@updateDispensation',   'as' => 'update-dispensation']);
Route::put('/dispense-drug/{id}',        ['uses' => 'Pharmacy\DispensationController@dispenseDrug',   'as' => 'dispense-drug']);

Route::get('/lab',                ['uses' => 'Lab\LabController@getHome','as' => 'lab-home']);
Route::get('/lab-records',        ['uses' => 'Lab\LabController@getRecords','as' => 'lab-records']);
Route::get('/lab-past-records',   ['uses' => 'Lab\LabController@getPastRecords','as' => 'past-records']);

Route::get('/medical-profile',    ['uses' => 'Medical\MedicalController@getHome','as' => 'medical-profile', 'middleware'=> 'auth:doctor']);
Route::put('/checkout/{id}',           ['uses' => 'Doctor\DoctorController@consulted', 'as' => 'consulted']);
Route::put('/patient/{id}',               ['uses' => 'Medical\PatientController@updatePatient', 'as' => 'updatePatient']);
Route::post('/health-vitals',             ['uses' => 'Medical\VitalsController@addVitals', 'as' => 'add-vitals']);
Route::post('/prescribe-medication',             ['uses' => 'Medical\MedicationController@prescribeMedication', 'as' => '/prescribe-medication']);
Route::post('/diagnosis',             ['uses' => 'Medical\DiagnosisController@addDiagnosis', 'as' => 'add-diagnosis']);
Route::post('/immunizations',             ['uses' => 'Medical\ImmunizationController@addImmunization', 'as' => 'add-immunization']);
Route::post('/therapies',             ['uses' => 'Medical\TherapyController@addTherapy', 'as' => 'add-therapy']);
Route::post('/procedures',             ['uses' => 'Medical\ProcedureController@addProcedure', 'as' => 'add-procedure']);


});


