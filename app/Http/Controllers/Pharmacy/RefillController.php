<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;
use App\Dispensation;
use App\Inventory;
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

    public function refillNew(Request $request)
    {
    	$this->validate($request, [
                'name'               => 'required',
                'formulation'        => 'required',
                'quantity'           => 'required'
        ]);

    	$name                        = $request->input('name');
    	$formulation                 = $request->input('formulation');
    	$description                 = $request->input('description');
    	$quantity                    = $request->input('quantity');
    	$user                        = $request->user()->name;


    	Refill::create([
                'drugName'           => $name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity,
                'createdBy'          => $user
        ]);

    	Inventory::create([
    			'drugName'           => $name,
    			'formulation'        => $formulation,
    			'description'        => $description,
    			'quantity'           => $quantity
    	]);

    	$dispensations = Dispensation::paginate(10);

    	return redirect()->route('pharmacy-refills')->with('info', 'Refill for '.$name.' has been done successfully');
    }
}
