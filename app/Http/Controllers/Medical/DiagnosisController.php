<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Diagnosis;
use App\Vital;
use Auth;
use DB;
use Input;
use Session;

class DiagnosisController extends Controller
{
    public function addDiagnosis(Request $request)
    {
    	//Get current user staff Id
        $from_user = Auth::user()->id;

    	$this->validate($request, [
                'diagnosis_title'    => 'required|max:265',
                'diagnosis_fromdate' => 'required|max:20',
                'diagnosis_todate'   => 'required|max:20',
                'diagnosis_notes'    => 'required|max:2000'
        ]);

        Diagnosis::create([
                'onPatient'          => $request->input('onPatient'),
                'diagnosis'          => $request->input('diagnosis_title'),
                'from_date'          => $request->input('diagnosis_fromdate'),
                'to_date'            => $request->input('diagnosis_todate'),
                'notes'              => $request->input('diagnosis_notes'),
                'from_user'          => $from_user,
        ]);


        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $medId = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');

        //Get patients record
        $patient = DB::table('patients')->where('medId', $medId)->first(); 

        //Get vitals records
        $vitals = Vital::where('onPatient', $request->input('onPatient'))->paginate(10);

        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                 ->where('status','Awaiting Consultation');

        $patientname = $patient->firstName;
        Session::flash('info', 'The diagnosis has been successfully added.');

        $drugs = DB::table('inventories')->get();
       
    	return redirect()->route('medical-profile', compact('drugs')); 
    
    }
}
