@if(count($refills)===0)
<h5>Sorry, you don't have any refills.</h5>
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
                @foreach($refills->reverse() as $refill)
                <tr>
                    <td>
                        {{ $refill->medId }}
                    </td>
                    <td>
                        {{ $refill->patient }}
                    </td>
                    <td>
                        {{ $refill->serviceType }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($refill->created_at)->diffForHumans() }}
                    </td>
                    <td>
                        <span class="text-info">{{ $refill->status }}</span>
                    </td>
                    <td class="center">
                                @if($refill->status === "Awaiting Consultation")
                                <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".consult-{{$refill->id}}"><i class="fa fa-check"></i> Consult Patient</button>
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".refill-{{$refill->id}}" value="">Cancel <i class="fa fa-times"></i></button>
                                @endif
                    </td>
                </tr>
                <div class="modal fade refill-{{$refill->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this refill?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this refill?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$refill->id]])!!}
                                {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Consult Modal -->
                        <div class="modal fade consult-{{$refill->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-check"></i>
                                Confirm Consultation</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to consult <strong></strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$refill->id]])!!}
                                {!! Form::submit('Yes, Consult Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
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
                    {{ $refills->links() }}
                </ul>
            </div>
        </div>
        @endif