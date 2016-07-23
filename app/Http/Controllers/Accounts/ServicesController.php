<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use App\Http\Requests;
use Session;
use Auth;
use DB;
use App\User;

class ServicesController extends Controller
{
    //GET EXPENSES
    public function getServices(Request $request)
    {
        $payments  = DB::table('payments')->where('status', "Not Paid")->get();

        $services = Service::paginate(10);

        $user = Auth::user()->id;

        return view('templates.accounts.services', compact('services', 'user', 'users', 'payments'));    
    }

    public function addService(Request $request)
    {
    	$this->validate($request, [
                'service'         => 'required|max:265',
                'cost'            => 'required|max:10',
                'status'          => 'required'
        ]);

        Service::create([
                'service'         => $request->input('service'),
                'cost'            => $request->input('cost'),
                'status'          => $request->input('status'),
                'createdBy'       => $request->user()->id,
                'updatedBy'       => $request->user()->id,
        ]);


        Session::flash('info', 'The service have been successfully added.');

    	return redirect()->route('accounts-services'); 
    }

    public function deleteService($id)
    {   
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('accounts-services')->with('info', 'You have deleted successfully the service.');
    }

    public function updateService($id, Request $request)
    {
    	$this->validate($request, [
                'service'             => 'required|max:265',
                'cost'                => 'required|max:20',
                'status'              => 'required',
        ]);

        $updatedBy = Auth::user()->fullname;

        $service = Service::where('id', $id)->first();
        $input = $request->all();
        $service->fill($input)->save();

        Session::flash('info', 'The service has been successfully updated.');

        return redirect()->route('accounts-services'); 
    }

    public function searchService(Request $request){

        $query = $request->input('search');
        $services = DB::table('services')->where('id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('service', 'LIKE', '%' . $query . '%')
                                        ->orWhere('cost', 'LIKE', '%' . $query . '%')
                                        ->orWhere('createdBy', 'LIKE', '%' . $query . '%')
                                        ->orWhere('updatedBy', 'LIKE', '%' . $query . '%')
                                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

        $user = Auth::user()->id;

        Session::flash('info', 'There are ' . count($services) .' search results for "'. $query . '".' );
                   	
        return view('templates.accounts.services', compact('services', 'user'));   
    }
}
