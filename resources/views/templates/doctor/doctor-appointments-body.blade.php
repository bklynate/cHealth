@if(count($appointments)===0)
<h5>Sorry, you don't have any pending appointments.</h5>
@else
@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:10%">Med ID.</th>
                    <th style="width:20%">Patient</th>
                    <th style="width:15%">Doctor</th>
                    <th style="width:15%">Time</th>
                    <th style="width:15%">Status</th>
                    <th style="width:25%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments->reverse() as $appointment)
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
                                @if($appointment->status === "Awaiting Consultation")
                                <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".consult-{{$appointment->id}}"><i class="fa fa-check"></i> Consult Patient</button>
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".appointment-{{$appointment->id}}" value="">Cancel <i class="fa fa-times"></i></button>
                                @endif
                    </td>
                </tr>
                <div class="modal fade appointment-{{$appointment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                Please, Confirm to cancel this appointment?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this appointment?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Doctor\DoctorController@cancelAppointment',$appointment->id]])!!}
                                {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Consult Modal -->
                        <div class="modal fade consult-{{$appointment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                Confirm Consultation</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to consult <strong>{{ $appointment->patient }}</strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$appointment->id]])!!}
                                {!! Form::submit('Consult Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Consult Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <ul class="pagination">
                    {{ $appointments->links() }}
                </ul>
            </div>
        </div>
        @endif