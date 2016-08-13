<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Insurance;
use App\Payment;
use App\Http\Requests;
use Session;
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

    	//change payment status to paid
    	//and change payment insurance to 1 
        Payment::where('id', $id)->where('status', "Not Paid")->update(['status'=>"Paid"]);

        Payment::where('id', $id)->where('insurance', 0)->update(['insurance'=> 1]);

        //Payment::where('medId', $medId)->where('status', "Not Paid")->update(['status'=>"Paid"]);

        return redirect()->route('accounts-insurance')->with('info-insurance', 'The Insurance has been created successfully.');
    }

    public function updateInsurance($id, Request $request)
    {
        $this->validate($request, [
                'provider'             => 'required',
                'insId'                => 'required'
        ]);

        $updatedBy = $request->user()->id;

        $insurance = Insurance::where('id', $id)->first();
        $input = $request->all();
        $insurance->fill($input)->save();

        return redirect()->route('accounts-insurance')->with('info-insurance', 'The Insurance payment has been updated successfully.');
    }

    public function searchInsurance(Request $request)
    {
        $query = $request->input('search');

        $insurances = DB::table('insurances')->where('id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('medId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('insId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('patient', 'LIKE', '%' . $query . '%')
                                        ->orWhere('service', 'LIKE', '%' . $query . '%')
                                        ->orWhere('cost', 'LIKE', '%' . $query . '%')
                                        ->orWhere('provider', 'LIKE', '%' . $query . '%')
                                        ->orWhere('createdBy', 'LIKE', '%' . $query . '%')
                                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

        $payments  = DB::table('payments')->where('status', "Not Paid")->get();

        Session::flash('info-insurance', 'There were ' . count($insurances) .' search results for "'. $query . '".' );
                
        return view('templates.accounts.insurance', compact('payments', 'insurances'));

    }

    public function deleteInsurance($id)
    {
    	$insurance = Insurance::find($id);
        $patientName = $insurance->patient;
        $insurance->delete();
        return redirect()->route('accounts-insurance')->with('info-insurance', 'You have deleted the insurance payment for '.$patientName .' successfully.');
    }
}
