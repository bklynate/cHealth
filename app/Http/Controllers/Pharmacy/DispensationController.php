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
        return view('templates.pharmacy.dashboard', compact('dispensations'));
    }

    public function getDispensation()
    {
    
    	$dispensations = Dispensation::paginate(10);
    	return view('templates.pharmacy.dispensations', compact('dispensations'));
    }

    public function getInventory()
    {
    	return view('templates.pharmacy.dashboard');
    }


}
