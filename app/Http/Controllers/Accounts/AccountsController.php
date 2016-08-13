<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Service;
use App\Insurance;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Appointment;
use App\Dispensation;
use Session;
use Auth;

class AccountsController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        $payments  = DB::table('payments')->where('status', "Not Paid")->get();
        return view('templates.accounts.home', compact('payments'));
    }

    //GET PAYMENTS
    public function getPayments()
    {   
        $payments  = DB::table('payments')->where('status', "Not Paid")->get();

        $allpayments  = DB::table('payments')->paginate(10);

        $user = Auth::user()->id;

        return view('templates.accounts.payments', compact('payments', 'allpayments', 'user'));
    }

    //GET REPORTS
    public function getReports()
    {
        return view('templates.accounts.reports');
    }

    public function confirmPayment(Request $request, $medId)
    {
        //Update the appointment status field
        Appointment::where('medId', $medId)->where('status', "Accounts")->update(['status' => "Awaiting Consultation"]);

        Payment::where('medId', $medId)->where('status', "Not Paid")->update(['status'=>"Paid"]);

        
        //$drugId = Payment::`
        //$drug   = "d".$medId;
        //$drugId = $request->input("d".$medId);
        $drugId = "D-1"; 

       /* $payment_medication = Dispensation::where('medId', $medId)
                                        ->where('drugId', $drugId)
                                        ->where('status', 0)
                                        ->get();
        $payment_medication = count($payment_medication);

        if($payment_medication==1)
        {*/
            Dispensation::where('medId', $medId)
                                        ->where('drugId', $drugId)
                                        ->where('paid', 0)
                                        ->update(['paid'=> 1]);  
        /*}*/

        Session::flash('info', 'The payment has been confirmed successfully.');

        return redirect()->route('accounts-payments');
    }

    public function searchPayment(Request $request)
    {
        $query = $request->input('search');
        $allpayments = DB::table('payments')->where('id', 'LIKE', '%' . $query . '%')
                                        ->orWhere('medId', 'LIKE', '%' . $query . '%')
                                        ->orWhere('patient', 'LIKE', '%' . $query . '%')
                                        ->orWhere('status', 'LIKE', '%' . $query . '%')
                                        ->orWhere('serviceType', 'LIKE', '%' . $query . '%')
                                        ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                                        ->paginate(10);

        $user = $request->user()->id;

        $payments  = DB::table('payments')->where('status', "Not Paid")->get();

        Session::flash('info', 'There were ' . count($allpayments) .' search results for "'. $query . '".' );
                
        return view('templates.accounts.payments', compact('payments', 'allpayments' , 'user'));

    }

    public function updatePayment($id, Request $request)
    {
        $this->validate($request, [
                'status'              => 'required'
        ]);

        $updatedBy = $request->user()->id;

        $payment = Payment::where('id', $id)->first();
        $input = $request->all();
        $payment->fill($input)->save();

        Session::flash('info', 'The payment change has been successfully updated.');

        return redirect()->route('accounts-payments'); 
    }
}
