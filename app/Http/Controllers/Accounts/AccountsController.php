<?php

namespace App\Http\Controllers\Accounts;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;

class AccountsController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        return view('templates.accounts.home');
    }

    //GET PAYMENTS
    public function getPayments()
    {   
        $payments = Payment::paginate(10);
        return view('templates.accounts.payments', compact('payments'));
    }

    //GET EXPENSES
    public function getExpenses()
    {
        return view('templates.accounts.expenses');
    }

    //GET INSURANCE
    public function getInsurance()
    {
        return view('templates.accounts.insurance');
    }

    //GET REPORTS
    public function getReports()
    {
        return view('templates.accounts.reports');
    }
}
