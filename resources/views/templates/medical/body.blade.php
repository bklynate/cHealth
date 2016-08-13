@if(!$patient)
Sorry, no medical profile is shown since there isn't any selected appointment.

@else
@if($errors->any())
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
<div class="panel panel-default">
    <div class="h5 panel-heading bg-light lt">
        Medical Profile
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-8">
                    <span class="thumb-lg">
                    <img src="http://newtricks.com/wp-content/uploads/2011/06/unknown-128.jpg" class="img-circle"></span>
                </span>
                <p>
                    <h4>{{ $patient->firstName }} {{ $patient->middleName }} {{ $patient->lastName }}</h4> ID. No: {{ $patient->identification }}
                    <br> Age: {{ Carbon\Carbon::parse($patient->dateOfBirth)->age }} years
                    <br>
                </p>
            </div>
            <div class="col-md-3 pull-right">
                <div class="form-group">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target=".consulted-{{$appointment->id}}"><i class="fa fa-user-md"></i> Check Out</a>
                        <a class="btn btn-info btn-sm" data-toggle="modal" data-target=".refer-{{$appointment->id}}"> Refer</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout patient-->
        <div class="modal fade consulted-{{$appointment->id}}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info dk">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="blue bigger">
                        <i class="fa fa-check"></i>
                        Confirm Checkout</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <p>Are you sure you want to check out this patient?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!!Form::open()!!}
                        {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                        {!!Form::close()!!}
                        {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consulted',$appointment->id]])!!}
                        {!! Form::submit('Yes, Checkout Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                        {!!Form::close()!!}
                    </div>
                </div>
                </div><!-- /. modal dialog -->
            </div>
            <!-- Checkout patient-->

            <!-- Refer patient-->
        <div class="modal fade refer-{{$appointment->id}}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info dk">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">
                        Refer Patient</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="form-group">
                                <label>Kindly choose the department to refer the patient.</label><br><br>
                                    <select class="col-md-6">
                                        <option class="">Consultation</option>
                                        <option class="">Dentist</option>
                                        <option class="">Optician</option>
                                        <option class="">Emergency</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!!Form::open()!!}
                        {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                        {!!Form::close()!!}
                        {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consulted',$appointment->id]])!!}
                        {!! Form::submit('Refer Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                        {!!Form::close()!!}
                    </div>
                </div>
                </div><!-- /. modal dialog -->
            </div>
            <!-- Refer patient-->
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" ng-transclude="">
                    <li role="presentation"><a href="#demographics" aria-controls="home" role="tab" data-toggle="tab">Demographics</a></li>
                    <li role="presentation"><a href="#health_vitals" aria-controls="health_vitals" role="tab" data-toggle="tab">Health Vitals</a></li>
                    <li role="presentation"><a href="#medical_history" aria-controls="medical_history" role="tab" data-toggle="tab">Medical History</a></li>
                    <li role="presentation"><a href="#medication" aria-controls="medication" role="tab" data-toggle="tab">Medications</a></li>
                    <li role="presentation"><a href="#allergies" aria-controls="allergies" role="tab" data-toggle="tab">Allergies</a></li>
                    <li role="presentation"><a href="#lab_records" aria-controls="lab_records" role="tab" data-toggle="tab">Lab Records</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active b-l b-r b-b wrapper" id="demographics">
                        <a class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".update-demographics1"><i class="fa fa-pencil"></i> Update Demographics</a>
                        <div class="row col-md-12">
                            <h1 class="h6 m-b-sm m-t-sm text-muted">Primary Details</h1>
                            <div class="col-md-6">
                                <small class="m-t-xs">
                                <p class="h6 m">
                                    <span class="text-muted">First Name:</span> {{ $patient->firstName }}
                                </p>
                                <p class="h6 m">
                                    <span class="text-muted">Middle Name:</span> {{ $patient->middleName }}<br>
                                </p>
                                <p class="h6 m">
                                    <span class="text-muted">Last Name:</span> {{ $patient->lastName }}<br>
                                </p>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="m-t-xs">
                                <p class="h6 m">
                                    <span class="text-muted">Gender:</span> {{ $patient->gender }}<br>
                                </p>
                                @if($patient->dateOfBirth=="")
                                <p class="h6 m">
                                    <span class="text-muted">Date of Birth:</span> N/A<br>
                                </p>
                                @else
                                <p class="h6 m">
                                    <span class="text-muted">Date of Birth:</span> {{ $patient->dateOfBirth }}<br>
                                </p>
                                @endif
                                @if($patient->estimatedAge=="")
                                <p class="h6 m">
                                    <span class="text-muted">Estimated Age:</span> N/A<br>
                                </p>
                                @else
                                <span class="text-muted">Estimated Age:</span> {{ $patient->estimatedAge }}<br>
                                @endif
                                </small>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <h1 class="text-muted h6 m-b-sm m-t-sm">Contact Details</h1>
                            <div class="col-md-6">
                                <small class="m-t-xs">
                                <p class="h6 m">
                                    <span class="text-muted">Patient Phone: </span> {{ $patient->patientPhone }}
                                </p>
                                <p class="h6 m">
                                    <span class="text-muted">Email:</span> {{ $patient->email }}<br>
                                </p>
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="m-t-xs">
                                <p class="h6 m">
                                    <span class="text-muted">Residence:</span> {{ $patient->residence }}<br>
                                </p>
                                <p class="h6 m">
                                    <span class="text-muted">County:</span> {{ $patient->county }}<br>
                                </p>
                                <p class="h6 m">
                                    <span class="text-muted">Country:</span> {{ $patient->countryOrigin }}<br>
                                </p>
                                </small>
                            </div>
                        </div>
                        <div class="">
                            <h1 class="text-muted h6 m-b-sm m-t-sm">Emergency Contact Details</h1>
                            <p class="h6 m">
                                <span class="text-muted">Phone:</span> {{ $patient->kinPhone }}
                                <br>
                            </p>
                        </div>
                    </div>
                    <!-- Update Details Modal -->
                    <div class="modal fade update-demographics1" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info dk">
                                    <h4 class="font-thin text-center">Update Patient Demographics <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! Form::open(['method'=>'PUT','action'=>['Medical\PatientController@updatePatient', $patient->id ]])!!}
                                            <div class="form-group col-md-6">
                                                <label>Primary Details</label>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{ $patient->firstName }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="middleName" placeholder="Middle Name"value="{{ $patient->middleName }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="lastName" placeholder="Last Name"
                                                    value="{{ $patient->lastName }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="dateOfBirth" placeholder="Date of Birth i.e. 11/11/1990" value="{{ $patient->dateOfBirth }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="estimatedAge" placeholder="or Estimated age" value="{{ $patient->estimatedAge }}">
                                                </div>
                                                @if($patient->gender === "Male")
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Gender:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="gender" value="Male" checked>
                                                            <i></i>
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="gender" value="Female">
                                                            <i></i>
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Gender:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="gender" value="Male">
                                                            <i></i>
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="gender" value="Female" checked>
                                                            <i></i>
                                                            Female
                                                        </label>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Contact Details</label>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="phone" class="form-control" name="patientPhone" placeholder="Patient Phone" value="{{ $patient->patientPhone }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="phone" class="form-control" name="kinPhone" placeholder="Next of Kin Phone" value="{{ $patient->kinPhone }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="emial" class="form-control" name="email" placeholder="Patient Email" value="{{ $patient->email }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="residence" placeholder="Residence" value="{{ $patient->residence }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="county" placeholder="County" value="{{ $patient->county }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="county" placeholder="County" value="{{ $patient->countryOrigin }}">
                                                    <!--    <select ui-jq="chosen" class="w-full" name="countryOrigin">
                                                        <optgroup label="Country" selected="{{ $patient->countryOrigin }}">
                                                            @include('templates.reception.select-countries')
                                                        </optgroup>
                                                    </select> -->
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer bg-light lt">
                                    <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Don't Update, Go Back</button>
                                    {!! Form::submit('Update Demographics', ['class' => 'btn btn-info btn-sm pull-right']) !!}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                            </div><!-- /. modal dialog -->
                            </div><!-- /. modal-->
                            <!-- End Update Details Modal -->
                            <div role="tabpanel" class="tab-pane b-l b-r b-b wrapper fade in" id="health_vitals">
                                <h1 class="h6 m-b-sm m-t-sm"></h1>
<<<<<<< HEAD
                                @if($vitals)
=======
                                @if(!$vitals)
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Health Vitals
                                        <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".health-vitals"><i class="fa fa-plus"></i> Add Health Vitals</button>
                                    </div>
                                    <div>
                                        <table class="table m-b-none">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Weight</th>
                                                    <th>Height</th>
                                                    <th>BMI</th>
                                                    <th>Blood Pressure</th>
                                                    <th>Pulse</th>
                                                    <th>Temp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($vitals->reverse() as $vital)
                                                <tr>
                                                    <td>{{ Carbon\Carbon::parse($vital->created_at)->diffForHumans() }}</td>
                                                    <td>{{$vital->weight}} Kg</td>
                                                    <td>{{$vital->height}} cm</td>
                                                    <td>{{$vital->bmi}}</td>
                                                    <td>{{$vital->weight}} bpm</td>
                                                    <td>{{$vital->weight}} bpm</td>
                                                    <td>{{$vital->temperature}}&deg;C</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="text-center">{{ $vitals->links() }}</div>
                                    </div>
                                </div>
<<<<<<< HEAD
                                @else
                                    There is no past vital recorded.
=======

                                @else
                                    Sorry. There aren't any Vitals.
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".health-vitals"><i class="fa fa-plus"></i> Add Health Vitals</button>
                                @endif
                            </div>
                            <!--  Health Vitals -->
                            <div class="modal fade health-vitals" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add Health Vitals <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\VitalsController@addVitals']])!!}
                                                    <div class="form-group col-md-6">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="text" class="form-control" name="weight" placeholder="Weight">
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="text" class="form-control" name="height" placeholder="Height">
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="text" class="form-control" name="bmi" placeholder="BMI">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="phone" class="form-control" name="bloodPressure" placeholder="Blood Pressure">
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="phone" class="form-control" name="pulse" placeholder="Pulse">
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input type="emial" class="form-control" name="temperature" placeholder="Temperature">
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Don't Save, Go Back</button>
                                            {!! Form::submit('Save Health Vitals', ['class' => 'btn btn-info btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                    <!-- Health Vitals -->
                                    <div role="tabpanel" class="tab-pane b-l b-r b-b wrapper fade in" id="medical_history">
                                        <h1 class="h6 m-b-sm m-t-sm"></h1>
<<<<<<< HEAD
                                        @if($diagnosis)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Diagnosis
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".diagnosis"><i class="fa fa-plus"></i> Add Diagnosis</button>
=======
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Active Diagnosis
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Diagnosis</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                            </div>
                                            <table class="table m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Diagnosis</th>
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<<<<<<< HEAD
                                                    @foreach($diagnosis->reverse() as $diagnos)
                                                    <tr>
                                                        <td>{{$diagnos->diagnosis}}</td>
                                                        <td>{{$diagnos->from_date}}</td>
                                                        <td>{{$diagnos->to_date}}</td>
                                                        <td>{{$diagnos->notes}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                        <div class="text-center">{{ $diagnosis->links() }}</div>
                                    </div>
                                        @else
                                    There is no past diagnosis recorded.
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".diagnosis"><i class="fa fa-plus"></i> Add Diagnosis</button>
                                @endif
                                        <!--  Add Diagnosis -->
                            <div class="modal fade diagnosis" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add Diagnosis<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\DiagnosisController@addDiagnosis']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="diagnosis_title" placeholder="Diagnosis" value="{{ old('diagnosis_title') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-6">
                                                            <input class="form-control" type="text" name="diagnosis_fromdate" placeholder="From Date" value="{{ old('diagnosis_fromdate') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-6">
                                                            <input class="form-control" type="text" name="diagnosis_todate" placeholder="To Date" value="{{ old('diagnosis_todate') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <textarea type="text" class="form-control" name="diagnosis_notes" placeholder="Notes on Diagnosis" rows="8" value="{{ old('diagnosis_notes') }}"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Add Diagnosis', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->

                                        <div class="wrapper"></div>
                                        @if(!$immunizations)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Immunizations
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".immunization"><i class="fa fa-plus"></i> Add Immunizations</button>
=======
                                                    <tr>
                                                        <td>Bandage of Wound</td>
                                                        <td>12/02/2016</td>
                                                        <td>20/02/2016</td>
                                                        <td>The patient needs to visit once every three days</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="wrapper"></div>
                                        <div class="line b-b"></div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Immunizations
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Immunizations</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                            </div>
                                            <table class="table m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Vaccine</th>
                                                        <th>Date/Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<<<<<<< HEAD
                                                    @foreach($immunizations->reverse() as $immunization)
                                                    <tr>
                                                        <td>{{$immunization->vaccine}}</td>
                                                        <td>{{$immunization->date_administered}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                        <div class="text-center">{{ $immunizations->links() }}</div>
                                    </div>
                                        @else
                                    There is no past immunization recorded.
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".immunization"><i class="fa fa-plus"></i> Add Immunization</button>
                                @endif
                                        <!--  Add Immunization -->
                            <div class="modal fade immunization" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add Immunization<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\ImmunizationController@addImmunization']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="vaccine_name" placeholder="Name of Vaccine" value="{{ old('vaccine_name') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="vaccine_date" placeholder="Date of Vaccine Administration" value="{{ old('vaccine_date') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Add Immunization', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                        <div class="wrapper"></div>
                                        @if(!$therapies)
                                        <div class="line b-b"></div>
                                        
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Injections/ Intravenous Therapies
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".therapy"><i class="fa fa-plus"></i> Add Injections/ Therapies</button>
=======
                                                    <tr>
                                                        <td>Hepatitis Kenya</td>
                                                        <td>12/02/2016</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="wrapper"></div>
                                        <div class="line b-b"></div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Injections/ Intravenous Therapies
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Injections/ Therapies</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                            </div>
                                            <table class="table table-striped m-b-none">
                                                <thead>
                                                    <tr>
<<<<<<< HEAD
                                                        <th>Name of Therapy</th>
                                                        <th>Date Administered</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($therapies->reverse() as $therapy)
                                                    <tr>
                                                        <td>{{ $therapy->therapy_name }}</td>
                                                        <td>{{ $therapy->date_administered }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                        <div class="text-center">{{ $therapies->links() }}</div>
                                    </div>
                                        @else
                                    There is no past therapy recorded.
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".therapy"><i class="fa fa-plus"></i> Add Therapy</button>
                                @endif
                                        <!--  Add Therapy -->
                            <div class="modal fade therapy" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add Therapy<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\TherapyController@addTherapy']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="therapy_name" placeholder="Name of therapy" value="{{ old('therapy_name') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="therapy_date" placeholder="Date administered" value="{{ old('therapy_date') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Add Therapy', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
                                        <div class="wrapper"></div>
                                        @if(!$procedures)
=======
                                                        <th>Vaccine</th>
                                                        <th>Date/Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Hepatitis Kenya</td>
                                                        <td>12/02/2016</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="wrapper"></div>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                        <div class="line b-b"></div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Procedures, Surgeries and Hospitalization
<<<<<<< HEAD
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".procedures"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
=======
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                            </div>
                                            <table class="table table-striped m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Type</th>
<<<<<<< HEAD
                                                        <th>Notes</th>
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                        <th>Duration</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($procedures->reverse() as $procedure)
                                                    <tr>
                                                        <td>{{ $procedure->procedure_name }}</td>
                                                        <td>{{ $procedure->procedure_type }}</td>
                                                        <td>{{ $procedure->procedure_notes }}</td>
                                                        <td>{{ $procedure->from_date }}</td>
                                                        <td>{{ $procedure->to_date }}</td>
                                                        <td>{{ $procedure->duration }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer">
                                        <div class="text-center">{{ $procedures->links() }}</div>
                                    </div>
                                        @else
                                    There is no past procedure, surgery, hospitalization etc. recorded.
                                    <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".procedures"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
                                @endif
                                        <!--  Add Procedure -->
                            <div class="modal fade procedures" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add procedures, surgeries etc.<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\ProcedureController@addProcedure']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="procedure_name" placeholder="Name of procedure, surgeries, hospitalizations etc." value="{{ old('procedure_name') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="procedure_type" placeholder="Type of procedure, surgery, hospitalization" value="{{ old('procedure_type') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <textarea class="form-control" type="text" name="procedure_notes" placeholder="Notes" value="{{ old('procedure_notes') }}"></textarea>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="from_date" placeholder="Starting Date" value="{{ old('from_date') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="to_date" placeholder="To Date" value="{{ old('to_date') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="duration" placeholder="Duration" value="{{ old('duration') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Add procedures, surgeries etc.', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
=======
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                        <th>Duration</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Left Leg Ankle</td>
                                                        <td>Light insertion</td>
                                                        <td>12/02/2016</td>
                                                        <td>12/02/2016</td>
                                                        <td>3hrs</td>
                                                        <td>12/02/2016</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                        <div class="wrapper"></div>
                                        <div class="line b-b"></div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Family and Social History
<<<<<<< HEAD
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".history"><i class="fa fa-plus"></i> Add Family and Social History</button>
=======
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Family and Social History</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                            </div>
                                            <table class="table table-striped m-b-none">
                                                <thead>
                                                    <tr>
                                                        <th>History</th>
                                                        <th>Relationship</th>
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                        <th>Status</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Diabetes</td>
                                                        <td>Mother</td>
                                                        <td>12/02/2016</td>
                                                        <td>92/02/2019</td>
                                                        <td>Alive</td>
                                                        <td>She underwent consistent medication</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
<<<<<<< HEAD
                                    <!--  Add Family and Social History -->
                            <div class="modal fade history" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Add Family and Social history<button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\ProcedureController@addProcedure']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="onPatient" value="{{ $patient->id }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="procedure_name" placeholder="Name of procedure, surgeries, hospitalizations etc." value="{{ old('procedure_name') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="procedure_type" placeholder="Type of procedure, surgery, hospitalization" value="{{ old('procedure_type') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <textarea class="form-control" type="text" name="procedure_notes" placeholder="Notes" value="{{ old('procedure_notes') }}"></textarea>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="from_date" placeholder="Starting Date" value="{{ old('from_date') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="to_date" placeholder="To Date" value="{{ old('to_date') }}"/>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <input class="form-control" type="text" name="duration" placeholder="Duration" value="{{ old('duration') }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Add procedures, surgeries etc.', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->
=======
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                                    <div role="tabpanel" class="tab-pane b-l b-r b-b wrapper fade in lter" id="medication">
                                        <div class="wrapper "></div>
                                        <div class="panel panel-default ">
                                            <div class="panel-heading ">
                                                Medications
                                                <button class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target=".medication"><i class="fa fa-plus"></i> Prescribe Medication</button>
                                            </div>
                                            <table class="table table-striped m-b-none ">
                                                <thead>
                                                    <tr>
                                                        <th>Prescription</th>
                                                        <th>Description</th>
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($medications->reverse() as $medication)
                                                    <tr>
                                                        <td>
                                                            {{ $medication->prescription }}
                                                        </td>
                                                        <td>
                                                            {{ $medication->description }}
                                                        </td>
                                                        <td>
                                                            {{ Carbon\Carbon::parse($medication->from_date)->toFormattedDateString() }}
                                                        </td>
                                                        <td>
                                                            {{ $medication->to_date }}
                                                            {{ Carbon\Carbon::parse($medication->to_date)->toFormattedDateString() }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{ $medications->links() }}
                                    </div>
                                    
                                    
<<<<<<< HEAD
                                    <!--  Prescribe Medication -->
=======
                                    <!--  Medication Vitals -->
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
                            <div class="modal fade medication" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info dk">
                                            <h4 class="font-thin text-center">Prescribe Medication <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method'=>'POST', 'action'=>['Medical\MedicationController@prescribeMedication']])!!}
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="patientMedId" value="{{ $patient->medId }}">
                                                        <div class="input-group m-b col-md-12">
                                                            <select class="form-control w-full" ui-jq="chosen" name="prescription">
                                                                <option class="text-muted">Select Prescription...</option>
                                                                @foreach($drugs as $drug)
                                                                    <option value="{{ $drug->drugId }}">{{ $drug->drugName }} ({{ $drug->formulation }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="input-group m-b col-md-12">
                                                            <textarea type="text" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light lt">
                                            <button class="btn btn-sm btn-default pull-left" data-dismiss="modal"> Go Back</button>
                                            {!! Form::submit('Prescribe Medication', ['class' => 'btn btn-info btn-sm pull-right']) !!}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                    </div><!-- /. modal dialog -->
                                    </div><!-- /. modal-->

                                    <div role="tabpanel " class="tab-pane b-l b-r b-b wrapper fade in lter " id="allergies">
                                        <div class="wrapper "></div>
                                        <div class="panel panel-default ">
                                            <div class="panel-heading ">
                                                Allergies
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Allergies</button>
                                            </div>
                                            <table class="table table-striped m-b-none ">
                                                <thead>
                                                    <tr>
                                                        <th>Allergen</th>
                                                        <th>Severity</th>
                                                        <th>Observed on</th>
                                                        <th>Status</th>
                                                        <th>Reactions</th>
                                                        <th>Options</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Methyl Fructose</td>
                                                        <td>severe</td>
                                                        <td>12/02/2016</td>
                                                        <td>Active</td>
                                                        <td>12/02/2016</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane b-l b-r b-b wrapper fade in lter " id="lab_records">
                                        <div class="wrapper "></div>
                                        <div class="panel panel-default ">
                                            <div class="panel-heading ">
                                                Lab Records
                                                <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Lab Record</button>
                                            </div>
                                            <table class="table table-striped m-b-none ">
                                                <thead>
                                                    <tr>
                                                        <th>Test</th>
                                                        <th>Lab</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Blood</td>
                                                        <td>General</td>
                                                        <td>12/02/2016</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row wrapper ">
                                    <a href=" " class="btn btn-info "><i class="fa fa-close "></i> Done with Record</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="h5 panel-footer bg-light lt ">
                    </div>
                </div>
                @endif