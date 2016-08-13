<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Procedure;
use Session;

class ProcedureController extends Controller
{
    public function addProcedure(Request $request)
    {
    	//Get current user staff Id
        $from_user = Auth::user()->id;

    	$this->validate($request, [
                'procedure_name'    => 'required|max:255',
                'procedure_type'    => 'required|max:255',
                'procedure_notes'   => 'required|max:2000',
                'from_date'         => 'required|max:20',
                'to_date'           => 'required|max:20',
                'duration'          => 'required|max:20'
        ]);

        Procedure::create([
                'onPatient'         => $request->input('onPatient'),
                'procedure_name'    => $request->input('procedure_name'),
                'procedure_notes'   => $request->input('procedure_notes'),
                'from_date'         => $request->input('from_date'),
                'to_date'           => $request->input('to_date'),
                'duration'          => $request->input('duration'),
                'from_user'         => $from_user
        ]);

        Session::flash('info', 'The patient\'s procedure, surgery, hospitalization etc. has been successfully added.');

    	return redirect()->route('medical-profile'); 
    }
}
