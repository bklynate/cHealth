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
                <div class="col-sm-12">
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
                <div class="col-md-4 col-sm-12">
                    <div class="form-group col-md-12">
                        <div class="btn-group btn-group-justified">
                            <a href="" class="btn btn-info">Check Out <i class="fa fa-user-md"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul id="medical_tabs" class="nav nav-tabs" role="tablist" ng-transclude="">
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
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Active Diagnosis
                                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Diagnosis</button>
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
                                    </div>
                                    <table class="table m-b-none">
                                        <thead>
                                            <tr>
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
                                <div class="line b-b"></div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Injections/ Intravenous Therapies
                                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Injections/ Therapies</button>
                                    </div>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                            <tr>
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
                                <div class="line b-b"></div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Procedures, Surgeries and Hospitalization
                                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Procedures, Surgeries etc.</button>
                                    </div>
                                    <table class="table table-striped m-b-none">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
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
                                <div class="wrapper"></div>
                                <div class="line b-b"></div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Family and Social History
                                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Family and Social History</button>
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
                            <div role="tabpanel" class="tab-pane b-l b-r b-b wrapper fade in lter" id="medication">
                                <div class="wrapper "></div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading ">
                                        Medications
                                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Add Medications</button>
                                    </div>
                                    <table class="table table-striped m-b-none ">
                                        <thead>
                                            <tr>
                                                <th>Prescription</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Methyl Fructose</td>
                                                <td>12/02/2016</td>
                                                <td>12/02/2016</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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