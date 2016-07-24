@if(count($appointments)===0)
<h5>Sorry, there are no appointments.</h5>
@else
@if (Session::has('info-patient'))
<div class="alert alert-info text-center btn-close" role="alert">
    {{ Session::get('info-patient') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-appointment', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Appointments" name="search" class="form-control" type="text" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:10%">Med ID.</th>
                    <th style="width:20%">Patient</th>
                    <th style="width:10%">Service</th>
                    <th style="width:15%">Time</th>
                    <th style="width:10%">Status</th>
                    <th style="width:15%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointmentsAll->reverse() as $appointment)
                <tr>
                    <td>
                        {{ $appointment->medId }}
                    </td>
                    <td>
                        {{ $appointment->patient }}
                    </td>
                    <td>
                        {{ $appointment->serviceType }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($appointment->created_at)->diffForHumans() }}
                    </td>
                    <td>
                        <span class="text-info">{{ $appointment->status }}</span>
                    </td>
                    <td class="center">
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit-{{$appointment->id}}"><i class="fa fa-pencil"></i> Edit</button>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".appointment-{{$appointment->id}}">
                        Cancel <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
                <!-- Edit Appointment -->
                <div class="modal fade appointment-{{$appointment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-times"></i>
                                Cancel Appointment</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this appointment?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$appointment->id]])!!}
                                {!! Form::submit('Yes, Cancel', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div>
                        <!-- Edit Appointment -->
                        <div class="modal fade edit-{{$appointment->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger text-center">
                                        <i class="fa fa-pencil"></i>
                                        Edit Payment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            {!! Form::open(['method'=>'PUT','action'=>['Reception\AppointmentsController@updateAppointment', $appointment->id]])!!}
                                            <div class="form-group col-md-11 col-md-offset-1">
                                                <label>
                                                    Edit Appointment Service:
                                                </label><br>
                                                <select name="service" class="col-md-6">
                                                    @foreach($services as $service)
                                                    <option value="{{ $service->service }}">{{ $service->service }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        {!! Form::submit('Update Appointment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <ul class="pagination">
                            {{ $appointmentsAll->links() }}
                        </ul>
                    </div>
                </div>
                @endif