<?php

namespace App\Http\Controllers\Lab;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

class LabController extends Controller
{
    //GET HOME PAGE
    public function getHome()
    {
        return view('templates.lab.home');
    }

    //GET LAB RECORDS
    public function getRecords()
    {
        return view('templates.lab.lab-records');
    }

    //GET PAST RECORDS
    public function getPastRecords()
    {
        return view('templates.lab.past-records');
    }

}
