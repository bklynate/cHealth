<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;

class DoctorController extends Controller
{
    public function getAppointments(){
        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                    ->where('status','Awaiting Consultation')
                                                   ->paginate(10); 
        return $appointments;
    }
    //GET DASHBOARD PAGE
    public function getDashboard()
    {
        //Fetch doctor's appointments from getAppointments function in this class
        $appointments = $this->getAppointments();

        return view('templates.doctor.dashboard', compact('appointments'));
    }

    //GET APPOINTMENTS PAGE
    public function getDoctorAppointments()
    {
        //Fetch doctor's appointments from getAppointments function in this class
        $appointments = $this->getAppointments();

        // Pass appointments to doctor-appointments
        return view('templates.doctor.doctor-appointments', compact('appointments'));
    }

    //GET CONSULTATIONS PAGE
    public function getDoctorConsultations()
    {
        //Fetch doctor's appointments from getAppointments function in this class
        $appointments = $this->getAppointments();

        return view('templates.doctor.doctor-consultations', compact('appointments'));
    }

    //GET CALENDAR PAGE
    public function getDoctorCalendar()
    {
        return view('templates.doctor.doctor-calendar');
    }

    //CONSULT PATIENT
    public function consultPatient($id, $medId)
    {
        //Update the appointment status field
        Appointment::where('id', $id)
          ->update(['status' => "Consultation"]);

        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', "Consultation");

        //Get medId, based on the appointments table 
        $patientMedId = $appointment->medId;

        //Get patients record
        $patient = DB::table('patients')->where('medId', $patientMedId); 

        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                    ->where('status','Awaiting Consultation');

        return view('templates.medical.home', compact('appointments', 'patient'));
    }
}
