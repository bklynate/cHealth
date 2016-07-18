@if(count($patient)==0)
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@else
<div class="panel panel-default">
    <div class="panel-heading bg-light lt">
        There are {{ count($patient) }} search results for '<strong>{{$query}}</strong>'.
    </div>
    <div class="panel-body">
        <div class="tab-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href data-toggle="tab" data-target="#search_id">All Patients <span class="badge badge-sm m-l-xs">{{ count($patient) }}</span></a></li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane active bg-grey" id="search_id">
                    <ul class="list-group no-borders pull-in m-b-none animated fadeInDown">
                        @foreach($patient->reverse() as $patient)
                        {!!Form::open(['method'=>'POST', 'url'=>'create-appointment', 'action'=>['Reception\AppointmentsController@CreateAppointment']])!!}
                        <li class="list-group-item bg-light lt">
                            <div class="col-md-3 pull-right">
                                <select name="doctor" class="form-control m-b" required>
                                    <option>Select a Doctor...</option>
                                    @foreach($services as $service)
                                    <option value="{{$service->service}}">{{$service->service}} (Ksh. {{$service->cost}})</option>
                                    @endforeach
                                </select>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target=".appointment-{{$patient->id}}">Create an Appointment <i class="fa fa-calendar"></i></a>
                            </div>
                            <p>
                                <span class="h4 m-b-sm m-t-sm block">
                                    {{ $patient->firstName }} {{ $patient->middleName }} {{ $patient->lastName }}</span>ID: {{ $patient->identification }}<input name="medId" type="hidden" value="{{ $patient->medId }}"></input><br> Age: {{ $patient->dateOfBirth }} years.
                                <br>Gender: {{ $patient->gender }}</p>
                                <p><span class="label bg-info pos-rlt m-r inline wrapper-xs"><i class="arrow right arrow-info"></i> MED Id:</span> <span class="m-r-sm">{{ $patient->medId }}</span>
                                <br>
                            </p>
                        </li>
                        <hr>
                        <div class="modal fade appointment-{{$patient->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="gridSystemModalLabel">Create an Appointment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="wrapper">
                                                <h5>Are you sure you want to create an appointment?</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No, Go Back</button>
                                        
                                        {!! Form::submit('Yes, I\'m sure', ['class' => 'btn btn-info pull-right']) !!}
                                        
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                        </div>@endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif