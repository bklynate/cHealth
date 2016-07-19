<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Session;
use App\Medication;
use App\Vital;

class MedicationController extends Controller
{
    public function prescribeMedication(Request $request)
    {
    	$this->validate($request, [
                'prescription'    => 'required|max:256',
                'description'     => 'max:256',
                'from_date'       => '',
                'to_date'         => '',
        ]);

        Medication::create([
                'onPatient'       => $request->input('onPatient'),
                'from_user'       => $request->user()->id,
                'prescription'    => $request->input('prescription'),
                'description'     => $request->input('description'),
                'from_date'       => $request->input('from_date'),
                'to_date'         => $request->input('to_date'),
        ]);


        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        $patientId = $patient->id;
        
        //get appointment
        $medId = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');

        //Get patients record
        $patient = DB::table('patients')->where('medId', $medId)->first(); 

        //Get vitals records to display on medical profile
        $vitals = Vital::where('onPatient', $request->input('onPatient'))->paginate(10);

        //Get medications to display on medical profile
        $medications = Medication::where('onPatient', $patientId)->paginate(10);
        

        //Get appointments for the left navigation notification
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                 ->where('status','Awaiting Consultation');

        $patientname = $patient->firstName;

        Session::flash('info', 'You have prescribed the medication successfully.');


       
    	return redirect()->route('medical-profile'); 
    
    }
}
