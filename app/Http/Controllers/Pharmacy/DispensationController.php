<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Dispensation;
use App\Inventory;
use App\Http\Requests;
use Auth;
use Session;
use DB;

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
        $drugs = DB::table('inventories')->get();
    	return view('templates.pharmacy.dispensations', compact('dispensations', 'dispensationsCount', 'drugs'));
    }

    public function updateDispensation($id, Request $request)
    {
        $this->validate($request, [
                'prescription'             => 'max:256',
                'description'              => 'max:256',
        ]);

        $updatedBy = Auth::user()->fullname;

        $dispensation = Dispensation::where('id', $id)->first();
        $input = $request->all();
        $dispensation->fill($input)->save();

        Session::flash('info', 'The dispensation has been successfully updated.');

        return redirect()->route('pharmacy-dispensations'); 
    }

    public function dispenseDrug($id)
    {
        $updatedBy = Auth::user()->fullname;
        Dispensation::where('id', $id)->update(['status'=> 1]);
        //Dispensation::where('id', $id)->where('id', $id)->update(['status'=> 1]);

        $quantity_dispensed = DB::table('dispensations')->where('id', $id)->value('quantity_dispensed');
        
        $quantity_inventory = Inventory::where('drugId',$drugId)->value('quantity');

        Session::flash('info', 'You have successfully dispensed the drug.');

        return redirect()->route('pharmacy-dispensations'); 
    }

}
