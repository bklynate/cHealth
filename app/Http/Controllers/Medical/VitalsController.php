<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Vital;
use App\Http\Requests;
use Auth;
use DB;
use Session;

class VitalsController extends Controller
{
    public function addVitals(Request $request)
    {
    	$this->validate($request, [
                'weight'          => 'required|max:265',
                'height'          => 'required|max:20',
                'bmi'             => 'max:150',
                'bloodPressure'   => 'required|max:10',
                'pulse'           => 'max:20',
                'temperature'     => 'max:20'
        ]);

        Vital::create([
                'onPatient'       => $request->input('onPatient'),
                'from_user'       => $request->user()->id,
                'weight'          => $request->input('weight'),
                'height'          => $request->input('height'),
                'bmi'             => $request->input('bmi'),
                'bloodPressure'   => $request->input('bloodPressure'),
                'pulse'           => $request->input('pulse'),
                'temperature'     => $request->input('temperature')
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
        Session::flash('info', 'The patient\'s health vitals have been successfully added.');


       
    	return view('templates.medical.home', compact('appointments', 'patient', 'vitals'));
    
    }
}
