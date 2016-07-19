<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use App\Vital;
use App\Http\Requests;
use Session;
use App\Medication;

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
    public function getDoctorHistory()
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
    public function consultPatient($id)
    {
        //Update the appointment status field
        Appointment::where('id', $id)
          ->update(['status' => "Consultation"]);

        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');


        //Get patients record
        $patient = DB::table('patients')->where('medId', $appointment)->first(); 
        
        $vitals=0;
        if($patient){
            $patientId = $patient->id;

            //Get vitals records
            $vitals = Vital::where('onPatient', $patientId)->paginate(10);
            
            //Get appointment Id for checkout button
            $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status','Consultation')->first();  
            //Get medications to display on medical profile
            $medications = Medication::where('onPatient', $patientId)->paginate(10);

        } 
        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                  ->where('status','Awaiting Consultation')
                                                  ->paginate(10); 
        

        Session::flash('info', 'The patient\'s appointment status has been successfully changed to "Consultation".');

        return view('templates.medical.home', compact('appointments', 'appointment', 'patient', 'vitals', 'medications'));
    }

    //Onclick on the check out button in the medical profile
    public function consulted($id)
    {
        //Update the appointment status field
        Appointment::where('id', $id)
          ->update(['status' => "Consultated"]);

        Session::flash('info', 'The patient\'s appointment status has been successfully changed to "Consultated".');

        return redirect()->route('medical-profile');

    }
}
