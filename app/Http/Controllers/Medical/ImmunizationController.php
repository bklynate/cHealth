<?php

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Immunization;
use Session;

class ImmunizationController extends Controller
{
    public function addImmunization(Request $request)
    {
    	//Get current user staff Id
        $from_user = Auth::user()->id;

    	$this->validate($request, [
                'vaccine_name'      => 'required|max:265',
                'vaccine_date'      => 'required|max:20'
        ]);

        Immunization::create([
                'onPatient'         => $request->input('onPatient'),
                'vaccine'           => $request->input('vaccine_name'),
                'date_administered' => $request->input('vaccine_date'),
                'from_user'         => $from_user
        ]);

        Session::flash('info', 'The patient\'s immunization has been successfully added.');

    	return redirect()->route('medical-profile'); 
    }
}
