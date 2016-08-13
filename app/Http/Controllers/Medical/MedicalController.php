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
<<<<<<< HEAD
use App\Diagnosis;
use App\Immunization;
use App\Therapy;
use App\Procedure;
=======
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074

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
<<<<<<< HEAD
            $patientId = $patient->id;
=======
            $patientId = $patient->medId;
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074

            //Get vitals records
            $vitals = Vital::where('onPatient', $patientId)->paginate(10);

            //Get appointment Id for checkout button
            $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status','Consultation')->first();
            //Get medications to display on medical profile
            $medications = Medication::where('medId', $patientMedId)->paginate(10);
<<<<<<< HEAD

            //Get diagnosis to display on the medical profile
            $diagnosis = Diagnosis::where('onPatient', $patientId)->paginate(10);

            //Get immunizations to display on the medical profile
            $immunizations = Immunization::where('onPatient', $patientId)->paginate(10);

            //Get therapies to display on the medical profile
            $therapies = Therapy::where('onPatient', $patientId)->paginate(10);

            //Get procedures to display on the medical profile
            $procedures = Procedure::where('onPatient', $patientId)->paginate(10);
            
=======
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
        } 
        
        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                  ->where('status','Awaiting Consultation')
                                                  ->paginate(10); 
        $drugs = DB::table('inventories')->get();

<<<<<<< HEAD
        return view('templates.medical.home', 
                compact(
                        'appointments', 
                        'appointment', 
                        'patient', 
                        'vitals', 
                        'medications', 
                        'drugs',
                        'diagnosis',
                        'immunizations',
                        'therapies',
                        'procedures'
                ));
=======
        return view('templates.medical.home', compact('appointments', 'appointment', 'patient', 'vitals', 'medications', 'drugs'));
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
    }

}
