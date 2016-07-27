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
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target=".consult-{{$dispensation->id}}"><i class="fa fa-check"></i></button>
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
                                        <i class="fa fa-check"></i>
                                        Edit Dispensation</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                {!! Form::open(['method'=>'PUT','action'=>['Accounts\ServicesController@updateService']])!!}
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="prescription" placeholder="Name of Drug" value="{{ $dispensation->prescription }}">
                                                </div>
                                                <div class="input-group m-b col-md-12">
                                                    <input type="text" class="form-control" name="description" placeholder="Description"value="{{ $dispensation->description }}">
                                                </div>
                                                @if($service->status==1)
                                                    <div class="form-group col-md-12">
                                                        <label>
                                                            Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="1" checked>
                                                                <i></i>
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0">
                                                                <i></i>
                                                                Disable
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
                                                                Enable
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="0" checked>
                                                                <i></i>
                                                                Disable
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {!!Form::open()!!}
                                        {!! Form::submit('Go Back', ['class' => 'btn btn-sm btn-default pull-left', 'data-dismiss' => 'modal']) !!}
                                        {!!Form::close()!!}
                                        {!! Form::submit('Yes, Consult Patient', ['class' => 'btn btn-success btn-sm pull-right']) !!}
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