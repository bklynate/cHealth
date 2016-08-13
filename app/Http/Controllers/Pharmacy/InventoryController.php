<?php

namespace App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Inventory;
use App\Dispensation;
use App\Http\Requests;

class InventoryController extends Controller
{
    public function getInventory()
    {
    	$inventories = Inventory::paginate(10);
    	$dispensations = Dispensation::where('paid',1)->paginate(10);
    	$dispensationsActive = Dispensation::where('status', 0)->where('paid',1)->get();
        $dispensationsCount  = count($dispensationsActive);
        return view('templates.pharmacy.inventory', compact('inventories', 'dispensations', 'dispensationsCount'));
    }
}
