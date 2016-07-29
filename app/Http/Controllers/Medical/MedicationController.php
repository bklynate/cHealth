<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Session;
use App\Medication;
use App\Dispensation;
use App\Vital;

class MedicationController extends Controller
{
    public function prescribeMedication(Request $request)
    {
    	$this->validate($request, [
                'prescription'    => 'required|max:256',
                'description'     => 'max:256',
        ]);

        $patientMedId = $request->input('patientMedId');
        //Get patient details
        $patientFirstName  = DB::table('patients')->where('medId', $patientMedId)->value('firstName');
        $patientMiddleName = DB::table('patients')->where('medId', $patientMedId)->value('MiddleName');
        $patientLastName   = DB::table('patients')->where('medId', $patientMedId)->value('LastName');
        $patientId         = DB::table('patients')->where('medId', $patientMedId)->value('id');

        $patientName = $patientFirstName . ' ' . $patientMiddleName . ' ' . $patientLastName;
        $createdBy = Auth::user()->fullname;
        $drugId           = $request->input('prescription');

        $drugName         = DB::table('inventories')->where('drugId', $drugId)->value('drugName');
        $formulation      = DB::table('inventories')->where('drugId', $drugId)->value('formulation');
        $prescription     = $drugName . " (". $formulation.")";

        Medication::create([
                'medId'           => $patientMedId,
                'drugId'          => $drugId,
                'onPatient'       => $patientName,
                'from_user'       => Auth::user()->fullname,
                'prescription'    => $prescription,
                'description'     => $request->input('description'),
                'from_date'       => $request->input('from_date'),
                'to_date'         => $request->input('to_date'),
                'createdBy'       => $createdBy,
        ]);

        Dispensation::create([
                'medId'           => $patientMedId,
                'drugId'          => $drugId,
                'onPatient'       => $patientName,
                'from_user'       => Auth::user()->fullname,
                'drugId'          => $request->input('prescription'),
                'prescription'    => $prescription,
                'description'     => $request->input('description'),
                'status'          => 0,
        ]);


        //Get current user staff Id
        $staffId = Auth::user()->staffId;
        
        //get appointment
        $medId = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');

        //Get patients record
        $patient = DB::table('patients')->where('medId', $medId)->first(); 

        //Get vitals records to display on medical profile
        $vitals = Vital::where('onPatient', $patientId)->paginate(10);

        //Get medications to display on medical profile
        $medications = Medication::where('medId', $medId)->paginate(10);
        

        //Get appointments for the left navigation notification
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                 ->where('status','Awaiting Consultation');

        $patientname = $patient->firstName;

        Session::flash('info', 'You have prescribed the medication successfully.');

        $drugs = DB::table('inventories')->get();
       
    	return redirect()->route('medical-profile'); 
    
    }
}
