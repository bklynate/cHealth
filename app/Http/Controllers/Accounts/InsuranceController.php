<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Insurance;
use App\Http\Requests;

class InsuranceController extends Controller
{
    //GET INSURANCE
    public function getInsurance()
    {
        $payments   = DB::table('payments')->where('status', "Not Paid")->get();
        $insurances = DB::table('insurances')->paginate(10);
        return view('templates.accounts.insurance', compact('insurances', 'payments'));
    }

    public function createInsurance(Request $request)
    {
    	$this->validate($request, [
                'provider'             => 'required',
                'insId'                => 'required'
        ]);

    	//Get patient details
    	$medId                        = $request->input('medId');
    	$id                           = $request->input('id');
        $patientFirstName             = DB::table('patients')->where('medId', $medId)->value('firstName');
        $patientMiddleName            = DB::table('patients')->where('medId', $medId)->value('MiddleName');
        $patientLastName              = DB::table('patients')->where('medId', $medId)->value('LastName');
    	
    	$patientMedId                 = $medId;
    	$insId                        = $request->input('insId');
    	$patientName                  = $patientFirstName . ' ' . $patientMiddleName . ' ' . $patientLastName;
    	$service                      = DB::table('payments')->where('id', $id)->value('serviceType');
    	$cost                         = DB::table('payments')->where('id', $id)->value('cost');
    	$provider                     = $request->input('provider');
    	$createdBy 				      = Auth::user()->fullname;

    	Insurance::create([
                'medId'               => $patientMedId,
                'insId'               => $insId,
                'patient'             => $patientName,
                'service'             => $service,
                'cost'                => $cost,
                'provider'            => $provider,
                'createdBy'           => $createdBy,
        ]);
        return redirect()->route('accounts-insurance')->with('info', 'The Insurance has been created successfully.');
    }

    public function deleteInsurance($id)
    {
    	$insurance = Insurance::find($id);
        $patientName = $insurance->patient;
        $insurance->delete();
        return redirect()->route('accounts-insurance')->with('info', 'You have deleted successfully the insurance payment for '.$patientName .'.');
    }
}
