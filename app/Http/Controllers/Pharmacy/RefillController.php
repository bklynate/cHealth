<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;
use App\Dispensation;
use App\Refill;
use Illuminate\Http\Request;

use App\Http\Requests;

class RefillController extends Controller
{
    public function getRefill()
    {
    	$refills = Refill::paginate(10);
    	$dispensations = Dispensation::paginate(10);
        return view('templates.pharmacy.refill', compact('dispensations', 'refills'));
    }
}
