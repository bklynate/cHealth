<?php

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\Appointment;
use DB;
use Session;

class PatientController extends Controller
{
    public function searchPatient(){
    	$query = $request->input('search');
        $patient = DB::table('songs')->where('*', 'LIKE', '%' . $query . '%')->paginate(1000);
            
        return view('templates.reception.patient-results', compact('patient', 'query'));
    }

    public function RegisterPatient(Request $request)
    {
    	$this->validate($request, [
                'identification'        => 'required|min:4|max:50',
                'firstName'             => 'required|min:2|max:265',
                'middleName'            => 'max:265',
                'lastName'              => 'max:265',
                'dateOfBirth'           => 'max:20',
                'estimatedAge'          => 'max:150',
                'gender'                => 'required|max:10',
                'patientPhone'          => 'max:20',
                'kinPhone'              => 'max:20',
                'email'                 => 'max:265',
                'residence'             => 'required|min:2|max:100',
                'county'                => 'max:100',
                'countryOrigin'         => 'max:100',
            ]);

    	$createdBy = Auth::user()->fullname;

        //fetch id no of previous record and add one to it
        $fetchNo = Patient::all();

        if (count($fetchNo)!=0) {
            $fetchNo = DB::table('patients')->orderBy('created_at')->first()->id;
            $fetchNo = (int)$fetchNo;
            $fetchNo = $fetchNo + 1;

            $medId = "Med-" . $fetchNo;

        Patient::create([
                'identification'        => $request->input('identification'),
                'medId'                 => $medId,
                'firstName'             => $request->input('firstName'),
                'middleName'            => $request->input('middleName'),
                'lastName'              => $request->input('lastName'),
                'dateOfBirth'           => $request->input('dateOfBirth'),
                'estimatedAge'          => $request->input('estimatedAge'),
                'gender'                => $request->input('gender'),
                'patientPhone'          => $request->input('patientPhone'),
                'kinPhone'              => $request->input('kinPhone'),
                'email'                 => $request->input('email'),
                'residence'             => $request->input('residence'),
                'county'                => $request->input('county'),
                'countryOrigin'         => $request->input('countryOrigin'),
                'createdBy'             => $createdBy,
            ]);

        } else
        {
            $fetchNo = 1;
            $fetchNo = (int)$fetchNo;

            $medId = "Med-" . $fetchNo;

        Patient::create([
                'identification'        => $request->input('identification'),
                'medId'                 => $medId,
                'firstName'             => $request->input('firstName'),
                'middleName'            => $request->input('middleName'),
                'lastName'              => $request->input('lastName'),
                'dateOfBirth'           => $request->input('dateOfBirth'),
                'estimatedAge'          => $request->input('estimatedAge'),
                'gender'                => $request->input('gender'),
                'patientPhone'          => $request->input('patientPhone'),
                'kinPhone'              => $request->input('kinPhone'),
                'email'                 => $request->input('email'),
                'residence'             => $request->input('residence'),
                'county'                => $request->input('county'),
                'countryOrigin'         => $request->input('countryOrigin'),
                'createdBy'             => $createdBy,
            ]);
        }
        
        return redirect()->route('reception-registration')->with('info', 'The Patient\'s Medical Profile has been created successfully');
    }

    public function updatePatient($id, Request $request){
        $this->validate($request, [
                'firstName'             => 'required|min:2|max:265',
                'middleName'            => 'max:265',
                'lastName'              => 'max:265',
                'dateOfBirth'           => 'max:20',
                'estimatedAge'          => 'max:150',
                'gender'                => 'required|max:10',
                'patientPhone'          => 'max:20',
                'kinPhone'              => 'max:20',
                'email'                 => 'max:265',
                'residence'             => 'required|min:2|max:100',
                'county'                => 'max:100',
                'countryOrigin'         => 'max:100',
        ]);

        $updatedBy = Auth::user()->fullname;

        $patients = Patient::where('id', $id)->first();
        $input = $request->all();
        $patients->fill($input)->save();

        //Get current user staff Id
        $staffId = Auth::user()->staffId;

        //get appointment
        $appointment = DB::table('appointments')->where('staffId', $staffId)
                                                ->where('status', 'Consultation')->value('medId');

        //Get patients record
        $patient = DB::table('patients')->where('medId', $appointment)->first(); 
        $patientId = $patient->id;

        //Get vitals records
        $vitals = Vital::where('onPatient', $patientId)->paginate(10);

        //Get appointments for the navigation
        $appointments  = DB::table('appointments')->where('staffId', $staffId)
                                                 ->where('status','Awaiting Consultation');

        return view('templates.medical.home', compact('appointments', 'patient', 'vitals'));

    }
}
