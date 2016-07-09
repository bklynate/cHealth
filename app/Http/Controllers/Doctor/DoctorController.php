<?php

namespace App\Http\Controllers\Doctor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

class DoctorController extends Controller
{
    //GET DASHBOARD PAGE
    public function getDashboard()
    {
        return view('templates.doctor.dashboard');
    }

    //GET APPOINTMENTS PAGE
    public function getDoctorAppointments()
    {
        return view('templates.doctor.doctor-appointments');
    }

    //GET CONSULTATIONS PAGE
    public function getDoctorConsultations()
    {
        return view('templates.doctor.doctor-consultations');
    }

    //GET CALENDAR PAGE
    public function getDoctorCalendar()
    {
        return view('templates.doctor.doctor-calendar');
    }


}
