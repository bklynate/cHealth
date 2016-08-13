@if (Session::has('info-insurance'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info-insurance') }}
</div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
    {!! Form::open(array('route' => 'search-insurances', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search Insurances" name="search" class="form-control" type="text" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            <thead>
                <tr>
                    <th style="width:18%">Insurance Id.</th>
                    <th style="width:20%">Patient</th>
                    <th style="width:13%">Cost</th>
                    <th style="width:20%">Provider</th>
                    <th style="width:15%">Date</th>
                    <th style="width:15%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insurances->reverse() as $insurance)
                <tr>
                    <td>
                        {{ $insurance->insId }}
                    </td>
                    <td>
                        {{ $insurance->patient }}
                    </td>
                    <td>
                        Ksh. {{ $insurance->cost }}
                    </td>
                    <td>
                        {{ $insurance->provider }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($insurance->created_at)->toFormattedDateString() }}
                    </td>
                    <td class="center">
                        <div class="btn-group">
                            <label aria-invalid="false" class="btn btn-xs btn-default" btn-checkbox="" data-toggle="modal" data-target=".edit-insurance-{{$insurance->id}}"><i class="fa fa-edit"></i> Edit</label>
                            <label style="" aria-invalid="false" class="btn btn-xs btn-danger" btn-checkbox="" data-toggle="modal" data-target=".delete-insurance-{{$insurance->id}}"> Delete </label>
                        </div>
                    </td>
                </tr>
                <!-- Edit Insurance -->
                <div class="modal fade edit-insurance-{{$insurance->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-edit"></i>
                                Update Insurance payment</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    {!! Form::open(['method'=>'PUT','action'=>['Accounts\InsuranceController@updateInsurance', $insurance->id]])!!}
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" name="provider" value="{{ $insurance->provider }}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" class="form-control" name="insId" value="{{ $insurance->insId }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                {!! Form::submit('Update Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Edit Insurance -->
                        <!-- Delete Insurance -->
                        <div class="modal fade delete-insurance-{{$insurance->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="blue bigger">
                                        <i class="fa fa-trash"></i>
                                        Confirm to Delete Insurance</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <p>Are you sure you want to <b>Permanently</b> delete this insurance payment?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                        {!!Form::open(['method'=>'DELETE','action'=>['Accounts\InsuranceController@deleteInsurance',$insurance->id]])!!}
                                        {!! Form::submit('Yes, Delete', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Delete Insurance -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <ul class="pagination">
                            {{ $insurances->links() }}
                        </ul>
                    </div>
                </div>