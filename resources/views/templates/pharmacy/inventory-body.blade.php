@if(count($inventories)===0)
<h5>Sorry, you don't have any inventory.</h5>
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
                @foreach($inventories->reverse() as $inventories)
                <tr>
                    <td>
                        {{ $inventory->medId }}
                    </td>
                    <td>
                        {{ $inventory->patient }}
                    </td>
                    <td>
                        {{ $inventory->serviceType }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($inventory->created_at)->diffForHumans() }}
                    </td>
                    <td>
                        <span class="text-info">{{ $inventory->status }}</span>
                    </td>
                    <td class="center">
                                @if($inventory->status === "Awaiting Consultation")
                                <button class="btn btn-xs btn-success" data-toggle="modal" data-target=".consult-{{$inventory->id}}"><i class="fa fa-check"></i> Consult Patient</button>
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target=".inventory-{{$inventory->id}}" value="">Cancel <i class="fa fa-times"></i></button>
                                @endif
                    </td>
                </tr>
                <div class="modal fade inventory-{{$inventory->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this inventory?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this inventory?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$inventory->id]])!!}
                                {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Consult Modal -->
                        <div class="modal fade consult-{{$inventory->id}}" tabindex="-1">
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
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$inventory->id]])!!}
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
                    {{ $inventories->links() }}
                </ul>
            </div>
        </div>
        @endif