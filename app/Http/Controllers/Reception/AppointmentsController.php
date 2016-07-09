<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Appointment;
use App\Patient;
use App\Http\Requests; 
use DB;
use Auth;
use Illuminate\Database\Query\Builder;

class AppointmentsController extends Controller
{
    public function __construct(Patient $patient)
    {
        $this->patient    = $patient;
    }

    public function getAppointments(){
        //$appointments = DB::table('appointments')->paginate(15);
    	$appointments = Appointment::paginate(10);
        return view('templates.reception.appointments', compact('appointments'));
    }
    
    public function createAppointment(Request $request)
    {
    	$this->validate($request, [
                'doctor'              => 'required|min:2|max:256',
                'createdBy'           => 'max:20'
            ]);

        $patient = $request->input('id_no');

        //Get patient details
        $patientFirstName  = DB::table('patients')->where('identification', $patient)->value('firstName');
        $patientMiddleName = DB::table('patients')->where('identification', $patient)->value('MiddleName');
        $patientLastName   = DB::table('patients')->where('identification', $patient)->value('LastName');
        $patientMedId      = DB::table('patients')->where('identification', $patient)->value('medId');

        $patientName = $patientFirstName . ' ' . $patientMiddleName . ' ' . $patientLastName;

        //Appointment created by this logged in user.
        $createdBy = Auth::user()->fullname;

        Appointment::create([
                'medId'               => $patientMedId, 
                'patient'             => $patientName,
                'doctor'              => $request->input('doctor'),
                'status'              => 'Payment',
                'createdBy'           => $createdBy,
            ]);
        return redirect()->route('reception-patients')->with('info', 'The Appointment has been created successfully.');
    }

    public function cancelAppointment($id)
    {   
        $appointment = Appointment::find($id);
        $patientName = $appointment->patient;

        $appointment->delete();

        return redirect()->route('reception-appointments')->with('info', 'You have cancelled successfully the appointment for '.$patientName .'.');
    }
}
