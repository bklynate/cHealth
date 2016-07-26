<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Dispensation;
use App\Http\Requests;

class DispensationController extends Controller
{
    public function getHome()
    {
    	$dispensations = Dispensation::paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->get();
        $dispensationsCount  = count($dispensationsActive);
        return view('templates.pharmacy.dashboard', compact('dispensations', 'dispensationsCount'));
    }

    public function getDispensation()
    {
    	$dispensations = Dispensation::paginate(10);
        $dispensationsActive = Dispensation::where('status', 0)->get();
        $dispensationsCount  = count($dispensationsActive);
    	return view('templates.pharmacy.dispensations', compact('dispensations', 'dispensationsCount'));
    }

}
