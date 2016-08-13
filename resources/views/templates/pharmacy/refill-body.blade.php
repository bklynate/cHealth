@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        <button class="btn btn-sm btn-default btn-rounded pull-left" data-toggle="modal" data-target=".add-new-drug"><i class="fa fa-fw fa-plus"></i>New</button>
        <!-- Add new drug Modal -->
        <div class="modal fade add-new-drug" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info dk">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="blue bigger">
                        <i class="fa fa-plus"></i>
                        Add New Drug</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {!! Form::open(['method'=>'POST', 'action'=>['Pharmacy\RefillController@refillNew']])!!}
                            <div class="col-xs-12 col-sm-12">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="drugName" placeholder="Name of Drug" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="formulation" required>
                                        <option value="">Choose Formulation</option>
                                        <option value="Pills">Pills</option>
                                        <option value="Tablets">Tablets</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control" name="quantity" placeholder="Quantity" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light lt">
                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">No, Go Back</button>
                        {!! Form::submit('Add New Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                        {!!Form::close()!!}
                    </div>
                </div>
                </div><!-- /. modal dialog -->
                </div><!-- /. modal-->
                <!-- Add new drug Modal -->
                <button class="btn btn-sm btn-default btn-rounded pull-left" data-toggle="modal" data-target=".refill-drugs"><i class="fa fa-fw fa-level-up"></i>Refill</button>
                <!-- Add new drug Modal -->
                <div class="modal fade refill-drugs" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-level-up"></i>
                                Refill Inventory Drug</h5>
                            </div>
                            <div class="modal-body">
                                {!!Form::open()!!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group col-md-12">
                                            <select class="form-control" name="formulation" required>
                                                <option value="">Choose Drug (in Inventory)</option>
                                                <option value="Panadol">Panadol</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" class="form-control" name="quantity" placeholder="Quantity" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('No, Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                                {!! Form::submit('Refill Drug', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Add new drug Modal -->
                        {!! Form::open(array('route' => 'search-insurances', 'class'=>'form-inline text-right')) !!}
                        <div class="form-group">
                            <div class="input-group">
                                <input placeholder="Search Refills" name="search" class="form-control" type="text" required>
                                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-responsive">
                            
                            <thead>
                                <tr>
                                    <th style="width:20%">Name of Drug</th>
                                    <th style="width:15%">Formulation</th>
                                    <th style="width:10%">Quantity</th>
                                    <th style="width:20%">Description</th>
                                    <th style="width:20%">Refilled By</th>
                                    <th style="width:20%">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($refills->reverse() as $refill)
                                <tr>
                                    <td>
                                        {{ $refill->drugName }}
                                    </td>
                                    <td>
                                        {{ $refill->formulation }}
                                    </td>
                                    <td>
                                        {{ $refill->quantity }}
                                    </td>
                                    <td>
                                        {{ str_limit($refill->description, $limit = 20, $end = '...') }}
                                    </td>
                                    <td>
                                        {{ $refill->createdBy }}
                                    </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($refill->created_at)->toFormattedDateString() }}
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