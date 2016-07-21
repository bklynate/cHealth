<?php

namespace App\Http\Controllers\Reception;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Appointment;
use App\Patient;
use App\Payment;
use App\Http\Requests; 
use DB;
use Auth;
use Illuminate\Database\Query\Builder;
use Session;

class AppointmentsController extends Controller
{
    public function __construct(Patient $patient)
    {
        $this->patient    = $patient;
    }

    public function getAppointments(){
    	$appointmentsAll = Appointment::paginate(10);
        $appointments = count(Appointment::all());

        return view('templates.reception.appointments', compact('appointments', 'appointmentsAll'));
    }
    
    public function createAppointment(Request $request)
    {
    	$this->validate($request, [
                'doctor'              => 'required|min:2|max:256',
                'createdBy'           => 'max:20'
            ]);

        $patient = $request->input('medId');

        //Get patient details
        $patientFirstName  = DB::table('patients')->where('medId', $patient)->value('firstName');
        $patientMiddleName = DB::table('patients')->where('medId', $patient)->value('MiddleName');
        $patientLastName   = DB::table('patients')->where('medId', $patient)->value('LastName');
        $patientMedId      = DB::table('patients')->where('medId', $patient)->value('medId');      

        $patientName = $patientFirstName . ' ' . $patientMiddleName . ' ' . $patientLastName;

        //Appointment created by this logged in user.
        $createdBy = Auth::user()->fullname;

        Appointment::create([
                'medId'               => $patientMedId, 
                'patient'             => $patientName,
                'serviceType'         => $request->input('doctor'),
                'staffId'             => '123422', //To be sorted
                'status'              => 'Accounts',
                'createdBy'           => $createdBy,
            ]);

        //To get cost and create appointment(Cannot come before the above Appointment::create since
        //in the case where the first appoinment hasn't been created the 1st select statement 
        //below would return error of integritiy constant violation since there isn't 
        //and appointment to select the medId from).
        $serviceType       = DB::table('appointments')->where('medId', $patient)->value('serviceType');
        $cost              = DB::table('services')->where('service', $serviceType)->value('cost'); 

        //Create Payment
        Payment::create([
                'medId'               => $patientMedId,
                'patient'             => $patientName,
                'status'              => "Not Paid",
                'cost'                => $cost,
                'serviceType'         => $serviceType,
                'receivedBy'          => $createdBy,
            ]);

        return redirect()->route('reception-patients')->with('info', 'The Appointment has been created successfully.');
    }

    public function cancelAppointment($id)
    {   
        $appointment = Appointment::find($id);
        $patientName = $appointment->patient;

        $appointment->delete();

        Session::flash('info-patient', 'The patient\'s appointment has been deleted successfully');

        return redirect()->route('reception-appointments')->with('info', 'You have canceled successfully the appointment for '.$patientName .'.');
    }
}
