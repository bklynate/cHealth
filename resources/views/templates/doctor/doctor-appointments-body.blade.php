@if(count($appointments)===0)
<h5>Sorry, you don't have any appointments currently.</h5>
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
                    <th style="width:5%">Med ID.</th>
                    <th style="width:15%">Patient</th>
                    <th style="width:10%">Doctor</th>
                    <th style="width:10%">Time</th>
                    <th style="width:5%">Status</th>
                    <th style="width:15%">Options</th>
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
                        <button class="btn btn-xs btn-info">{{ $appointment->status }}</button>
                    </td>
                    <td class="center">
                        <div class="btn-group btn-group-justified">
                       
                                <!-- <a href="{{ route('consultPatient',$appointment->id ) }}" class="btn btn-xs btn-success">Consult</a> -->
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$appointment->id]])!!}
                                {!! Form::submit('Consult', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                                
                                <!-- <a data-toggle="modal" data-target=".appointment-{{$appointment->id}}" type="submit" class="btn btn-xs btn-primary">Refer</a> -->
                        </div>
                        
                    </td>
                </tr>
                <div class="modal fade appointment-{{$appointment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this appointment?</h5>
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
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$appointment->id]])!!}
                                {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
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
                    {{ $appointments->links() }}
                </ul>
            </div>
        </div>
        @endif