@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-insurances', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Dispensations" name="search" class="form-control" type="text" required>
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
                    <th style="width:20%">Patient Name</th>
                    <th style="width:20%">Name of Drug</th>
                    <th style="width:15%">Description</th>
                    <th style="width:15%">Doctor</th>
                    <th style="width:25%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dispensations->reverse() as $dispensations)
                <tr>
                    <td>
                        {{ $dispensation->medId }}
                    </td>
                    <td>
                        {{ $dispensation->onPatient }}
                    </td>
                    <td>
                        {{ $dispensation->prescription }}
                    </td>
                    <td>
                        {{ $dispensation->description }}
                    </td>
                    <td>
                        {{ $dispensation->from_user }}
                    </td>
                    <td>
                        {{ $dispensation->quantity_dispensed }}
                    </td>
                    <td class="center">
                                <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".consult-{{$inventory->id}}"><i class="fa fa-eye"></i> View</button>
                    </td>
                </tr>
                <div class="modal fade dispensation-{{$dispensation->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this dispensation?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this dispensation?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'DELETE','action'=>['Reception\AppointmentsController@cancelAppointment',$dispensation->id]])!!}
                                {!! Form::submit('Cancel Appointment', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Consult Modal -->
                        <div class="modal fade consult-{{$dispensation->id}}" tabindex="-1">
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
                                        <p>Are you sure you want to consult <strong>{{ $dispensation->patient }}</strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-info pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!!Form::open(['method'=>'PUT','action'=>['Doctor\DoctorController@consultPatient',$dispensation->id]])!!}
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
                    {{ $dispensations->links() }}
                </ul>
            </div>
        </div>