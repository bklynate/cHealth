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
use Session;

class AccountsController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        $payments  = DB::table('payments')->where('status', "Not Paid");
        return view('templates.accounts.home', compact('payments'));
    }

    //GET PAYMENTS
    public function getPayments()
    {   
        $payments  = DB::table('payments')->paginate(10);
        return view('templates.accounts.payments', compact('payments'));
    }

    //GET INSURANCE
    public function getInsurance()
    {
        $payments  = DB::table('payments')->where('status', "Not Paid");
        $insurances = Insurance::paginate(10);
        return view('templates.accounts.insurance', compact('insurances', 'payments'));
    }

    //GET REPORTS
    public function getReports()
    {
        return view('templates.accounts.reports');
    }

    public function confirmPayment($id)
    {
        //Update the appointment status field
        Appointment::where('id', $id)
          ->update(['status' => "Awaiting Consultation"]);

        Session::flash('info', 'The payment has been confirmed successfully.');

        return redirect()->route('accounts-payments');
    }
}
