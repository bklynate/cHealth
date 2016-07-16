<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;
use App\Appointment;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Carbon\Carbon; 

class ReceptionController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        $appointments = count(Appointment::all());

        return view('templates.reception.home', compact('appointments'));
    }

    //GET PATIENTS
    public function getPatients()
    {
        return view('templates.reception.patients');
    }

    //GET PATIENT RESULTS
    public function getPatientsResults()
    {
        return view('templates.reception.patient-results');
    }

    //GET REGISTRATION
    public function getRegistration()
    {
        return view('templates.reception.registration');
    }

    //GET CALENDAR
    public function getCalendar()
    {
        return view('templates.reception.calendar');
    }

    //GET APPOINTMENTS
    public function getAppointments()
    {
        return view('templates.reception.appointments');
    }

    public function searchPatient(Request $request){

        $query = $request->input('search');
        $patient = DB::table('patients')->where('identification', 'LIKE', '%' . $query . '%')
                                        ->orWhere('firstName', 'LIKE', '%' . $query . '%')
                                        ->orWhere('middleName', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

        $services = DB::table('services')->get();
        return view('templates.reception.patient-results', compact('patient', 'query', 'services'));
    }

    public function searchAppointment(Request $request){

        $query = $request->input('search');
        $appointments = DB::table('appointments')->where('patient', 'LIKE', '%' . $query . '%')
                                        ->orWhere('serviceType', 'LIKE', '%' . $query . '%')
                                        ->orWhere('createdBy', 'LIKE', '%' . $query . '%')
                                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);


        return view('templates.reception.appointments', compact('appointments', 'query'));
    }
}
