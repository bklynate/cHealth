<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Insurance;
use App\Http\Requests;

class InsuranceController extends Controller
{
    public function createInsurance(Request $request, $medId, $id)
    {
    	$this->validate($request, [
                'provider'             => 'required',
                'insId'                => 'required'
        ]);

    	//Get patient details
        $patientFirstName  = DB::table('patients')->where('medId', $medId)->value('firstName');
        $patientMiddleName = DB::table('patients')->where('medId', $medId)->value('MiddleName');
        $patientLastName   = DB::table('patients')->where('medId', $medId)->value('LastName');
    	
    	$patientMedId                 = $medId;
    	$insId                        = $request->input('insId');
    	$patientName                  = $patientFirstName . ' ' . $patientMiddleName . ' ' . $patientLastName;
    	$service                      = DB::table('payments')->where('id', $id)
    														->value('serviceType');
    	$cost                         = $cost;
    	$provider                     = $request->input('provider');
    	$createdBy 				      = Auth::user()->fullname;

    	Insurance::create([
                'medId'               => $patientMedId,
                'insId'               => $insId
                'patient'             => $patientName,
                'service'             => $service,
                'cost'                => $cost,
                'provider'            => $provider,
                'createdBy'           => $createdBy,
        ]);
    }
}
