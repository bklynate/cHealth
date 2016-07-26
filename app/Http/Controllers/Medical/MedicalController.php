<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use App\Appointment;
use App\Patient;
use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Session;
use App\Http\Requests;
use App\Vital;
use App\Medication;

class MedicalController extends Controller
{
     //GET HOME PAGE
    public function getHome(Request $request)
    {
        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');

        //Get patients record
        $patient = DB::table('patients')->where('medId', $appointment)->first(); 
        $vitals=0;
        if($patient){
            $patientMedId = $patient->medId;
            $patientId = $patient->medId;

            //Get vitals records
            $vitals = Vital::where('onPatient', $patientId)->paginate(10);

            //Get appointment Id for checkout button
            $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status','Consultation')->first();
            //Get medications to display on medical profile
            $medications = Medication::where('medId', $patientMedId)->paginate(10);
        } 
        
        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                  ->where('status','Awaiting Consultation')
                                                  ->paginate(10); 
        $drugs = DB::table('inventories')->get();

        return view('templates.medical.home', compact('appointments', 'appointment', 'patient', 'vitals', 'medications', 'drugs'));
    }

}
