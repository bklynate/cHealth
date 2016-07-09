<?php

namespace App\Http\Controllers\Medical;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

class MedicalController extends Controller
{
     //GET HOME PAGE
    public function getHome()
    {
        return view('templates.medical.home');
    }

}
