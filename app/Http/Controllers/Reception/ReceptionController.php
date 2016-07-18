<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;
use App\Appointment;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Carbon\Carbon; 
use Session;
use App\Role;
use Auth;
use App\User;
use Illuminate\Contracts\Auth\Guard;

class ReceptionController extends Controller
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    //GET HOME PAGE
    public function getHome()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.home', compact('appointments'));
    }

    //GET PATIENTS
    public function getPatients()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.patients', compact('appointments'));
    }

    //GET PATIENT RESULTS
    public function getPatientsResults()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.patient-results', compact('appointments'));
    }

    //GET REGISTRATION
    public function getRegistration()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.registration', compact('appointments'));
    }

    //GET CALENDAR
    public function getDoctors()
    {
        $doctors = User::paginate(10);

        $appointments = count(Appointment::all());
        
        return view('templates.reception.doctors', compact('appointments', 'doctors'));
    }

    //GET APPOINTMENTS
    public function getAppointments()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.appointments', compact('appointments'));
    }

    public function searchPatient(Request $request){

        $query = $request->input('search');
        $patient = DB::table('patients')->where('identification', 'LIKE', '%' . $query . '%')
                                        ->orWhere('medId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('firstName', 'LIKE', '%' . $query . '%')
                                        ->orWhere('middleName', 'LIKE', '%' . $query . '%')
                                        ->orWhere('lastName', 'LIKE', '%' . $query . '%')
                                        ->orWhere('dateOfBirth', 'LIKE', '%' . $query . '%')
                                        ->orWhere('estimatedAge', 'LIKE', '%' . $query . '%')
                                        ->orWhere('gender', 'LIKE', '%' . $query . '%')
                                        ->orWhere('patientPhone', 'LIKE', '%' . $query . '%')
                                        ->orWhere('kinPhone', 'LIKE', '%' . $query . '%')
                                        ->orWhere('email', 'LIKE', '%' . $query . '%')
                                        ->orWhere('residence', 'LIKE', '%' . $query . '%')
                                        ->orWhere('county', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);
        $appointments = count(Appointment::all());
        $services = DB::table('services')->get();

        Session::flash('info', 'There were ' . count($patient) .' search results for "'. $query . '".' );

        return view('templates.reception.patient-results', compact('patient', 'query','appointments', 'services'));
    }

    public function searchAppointment(Request $request){

        $query = $request->input('search');
        $appointmentsAll = DB::table('appointments')->where('patient', 'LIKE', '%' . $query . '%')
                                        ->orWhere('serviceType', 'LIKE', '%' . $query . '%')
                                        ->orWhere('createdBy', 'LIKE', '%' . $query . '%')
                                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);
        $appointments = count(Appointment::all());

        Session::flash('info-patient', 'There were ' . count($appointmentsAll) .' search results for "'. $query . '".' );

        return view('templates.reception.appointments', compact('appointmentsAll','appointments', 'query'));
    }
}
