<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Therapy;
use Auth;
use Session;

class TherapyController extends Controller
{
    public function addTherapy(Request $request)
    {
    	//Get current user staff Id
        $from_user = Auth::user()->id;

    	$this->validate($request, [
                'therapy_name'       => 'required|max:265',
                'date_administered'  => 'required|max:20'
        ]);

        Therapy::create([
                'onPatient'         => $request->input('onPatient'),
                'therapy_name'      => $request->input('therapy_name'),
                'date_administered' => $request->input('date_administered'),
                'from_user'         => $from_user
        ]);

        Session::flash('info', 'The patient\'s therapy has been successfully added.');

    	return redirect()->route('medical-profile'); 
    }
}
