<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;
use App\Appointment;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;

class MedicalController extends Controller
{
     //GET HOME PAGE
    public function getHome()
    {
        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                    ->where('status','Awaiting Consultation')
                                                   ->paginate(10); 
        return view('templates.medical.home', compact('appointments'));
    }

}
