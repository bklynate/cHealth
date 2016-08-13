<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;
use App\Dispensation;
use App\Inventory;
use App\Refill;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use DB;

class RefillController extends Controller
{
    public function getRefill()
    {
    	$refills = Refill::paginate(10);
    	$dispensations = Dispensation::paginate(10);
    	$dispensationsActive = Dispensation::where('status', 0)->where('paid',1)->get();
        $dispensationsCount  = count($dispensationsActive);
        return view('templates.pharmacy.refill', compact('dispensations', 'refills','dispensationsCount'));
    }

    public function refillNew(Request $request)
    {
    	$this->validate($request, [
                'drugName'           => 'required',
                'formulation'        => 'required',
                'quantity'           => 'required'
        ]);

    	$name                        = $request->input('drugName');
    	$formulation                 = $request->input('formulation');
    	$description                 = $request->input('description');
    	$quantity                    = $request->input('quantity');
    	$user                        = Auth::user()->fullname;
    	

        $drugId = Inventory::all();
        if (count($drugId)!=0) {
            $drugId = DB::table('inventories')->get();
            $drugId = count($drugId);
            $drugId = (int)$drugId;
            $drugId = $drugId + 1;

            $drugId = "D-" . $drugId;

            Refill::create([
                'drugId'             => $drugId,
                'drugName'           => $name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity,
                'createdBy'          => $user
            ]);

            Inventory::create([
                'drugId'             => $drugId,
                'drugName'           => $name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity
             ]);

        } else {
            $drugId = 1;
            $drugId = (int)$drugId;

            $drugId = "D-" . $drugId;

            Refill::create([
                'drugId'             => $drugId,
                'drugName'           => $name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity,
                'createdBy'          => $user
            ]);

            Inventory::create([
                'drugId'             => $drugId,
                'drugName'           => $name,
                'formulation'        => $formulation,
                'description'        => $description,
                'quantity'           => $quantity
            ]);
        }

    	$dispensations = Dispensation::paginate(10);

    	return redirect()->route('pharmacy-refills')->with('info', 'Refill for '.$name.' has been done successfully');
    }
}
