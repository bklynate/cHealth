<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;

class MedicalController extends Controller
{
     //GET HOME PAGE
    public function getHome()
    {
        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');
        //Get medId, based on the appointments table
        //$patientMedId = $appointment->medId;

        //Get patients record
        $patient = DB::table('patients')->where('medId', $appointment)->first(); 

        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                    ->where('status','Awaiting Consultation');

        $patientUpdate = Patient::findOrFail($patient->id);

                                            
        return view('templates.medical.home', compact('appointments', 'patient', 'patientUpdate'));
    }

}
