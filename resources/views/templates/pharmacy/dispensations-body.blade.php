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
                    <th style="width:15%">Status</th>
                    <th style="width:20%">Doctor</th>
                    <th style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dispensations->reverse() as $dispensation)
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
                        @if(($dispensation->status)==0)
                        <span class="text-danger">Not Dispensed</span>
                        @else
                        Dispensed
                        @endif
                    </td>
                    <td>
                        {{ $dispensation->from_user }}
                    </td>
                    <td class="center">
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".view-{{$dispensation->id}}"><i class="fa fa-eye"></i> </button>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target=".edit-{{$dispensation->id}}"><i class="fa fa-edit"></i> </button>
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".dispense-{{$dispensation->id}}"><i class="fa fa-check"></i></button>
                    </td>
                </tr>
                <div class="modal fade view-{{$dispensation->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger text-center">
                                <i class="fa fa-eye"></i>
                                View Dispensation</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <label><strong>Medication ID:</strong> <i>{{ $dispensation->medId }}</i></label><br>
                                        <label><strong>Patient Name:</strong> <i>{{ $dispensation->onPatient }}</i></label><hr>
                                        <label><strong>Name of Drug:</strong> <i>{{ $dispensation->prescription }}</i></label><br>
                                        <label><strong>Description:</strong> <i>{{ $dispensation->description }}</i></label><br><hr>
                                        <label><strong>Prescribed by:</strong> <i>{{ $dispensation->from_user }}</i></label><br>
                                        <label><strong>Created on:</strong> <i>{{ $dispensation->created_at }}</i></label><br>
                                        <label><strong>Dispensed by:</strong> <i>{{ $dispensation->dispensedBy }}</i></label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                {!!Form::open()!!}
                                {!! Form::submit('Close', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        
                        <!-- Edit Modal -->
                        <div class="modal fade edit-{{$dispensation->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="blue bigger text-center">
                                        <i class="fa fa-edit"></i>
                                        Edit Dispensation</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                {!! Form::open(['method'=>'PUT','action'=>['Pharmacy\DispensationController@updateDispensation', $dispensation->id]])!!}
                                                <div class="input-group m-b col-md-12">
                                                    <select class="form-control w-full" ui-jq="chosen" name="prescription">
                                                        <option class="text-muted">Select Prescription...</option>
                                                        @foreach($drugs as $drug)
                                                        <option value="{{ $drug->drugName }} ({{ $drug->formulation }})">{{ $drug->drugName }} ({{ $drug->formulation }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="description" placeholder="Description"value="{{ $dispensation->description }}">
                                                </div>
                                                @if($dispensation->status==1)
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Status:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="status" value="1" checked>
                                                            <i></i>
                                                            Dispensed
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="status" value="0">
                                                            <i></i>
                                                            Not Dispensed
                                                        </label>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group col-md-12">
                                                    <label>
                                                        Status:
                                                    </label>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="status" value="1">
                                                            <i></i>
                                                            Dispensed
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="i-checks">
                                                            <input type="radio" name="status" value="0" checked>
                                                            <i></i>
                                                            Not Dispensed
                                                        </label>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Back</button>
                                        {!! Form::submit('Edit Dispensation', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Edit Modal -->
                                <!-- Dispense Modal -->
                                <div class="modal fade dispense-{{$dispensation->id}}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger text-center">
                                                <i class="fa fa-check"></i>
                                                Dispense Drug</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <label><strong>Medication ID:</strong> <i>{{ $dispensation->medId }}</i></label><br>
                                                        <label><strong>Patient Name:</strong> <i>{{ $dispensation->onPatient }}</i></label><hr>
                                                        <label><strong>Name of Drug:</strong> <i>{{ $dispensation->prescription }}</i></label><br>
                                                        <label><strong>Description:</strong> <i>{{ $dispensation->description }}</i></label><br><hr>
                                                        <label><strong>Prescribed by:</strong> <i>{{ $dispensation->from_user }}</i></label><br>
                                                        <label><strong>Created on:</strong> <i>{{ $dispensation->created_at }}</i></label><br>
                                                        <label><strong>Dispensed by:</strong> <i>{{ $dispensation->dispensedBy }}</i></label><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                {!!Form::open()!!}
                                                {!! Form::submit('Close', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                        </div><!-- /. modal dialog -->
                                        </div><!-- /. modal-->
                                        <!-- Dispense Modal -->
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