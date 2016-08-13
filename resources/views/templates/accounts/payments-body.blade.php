@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
@if(count($allpayments)===0)
<h5>Sorry, there are no processed payments.</h5>
@else
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-payment', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search payments" name="search" class="form-control" type="text" required>
                <div class="input-group-btn"><button class="btn btn-success" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-xs table-responsive">
            <thead>
                <tr>
                    <th style="width:8%">Med ID.</th>
                    <th style="width:20%">Patient Name</th>
                    <th style="width:10%">Status</th>
                    <th style="width:10%">Type</th>
                    <th style="width:12%">Service</th>
                    <th style="width:12%">Cost</th>
                    <th style="width:12%">Created</th>
                    <th class="text-center" style="width:20%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allpayments->reverse() as $payment)
                <tr>
                    <td>
                        {{ $payment->medId }}
                    </td>
                    <td>
                        {{ $payment->patient }}
                    </td>
                    <td>@if(($payment->status)==="Not Paid")
                        <span class="text-danger">{{ $payment->status }}</i></span>
                        @else
                        <span class="text-success">{{ $payment->status }}</i></span>
                        @endif
                    </td>
                    <td>@if(($payment->insurance)==0 && ($payment->status)==="Not Paid")
                        Pending
                        @elseif(($payment->insurance)==0 && ($payment->status)==="Paid")
                        Cash
                        @elseif(($payment->insurance)==1 && ($payment->status)==="Paid")
                        Insurance
                        @else
                        N/A
                        @endif
                    </td>
                    <td>
                        {{ $payment->serviceType }}
                    </td>
                    <td>
                        Ksh. {{ $payment->cost }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($payment->created_at)->toFormattedDateString() }}
                    </td>
                    <td class="center">
                        @if(($payment->status)==="Not Paid")
                        <div class="btn-group">
                            <label aria-invalid="false" class="btn btn-xs btn-success" btn-checkbox="" data-toggle="modal" data-target=".confirm-cash-{{$payment->id}}"><i class="fa fa-money"></i> Cash</label>
                            <label style="" aria-invalid="false" class="btn btn-xs btn-info" btn-checkbox="" data-toggle="modal" data-target=".confirm-insurance-{{$payment->id}}"> Insure <i class="fa fa-credit-card"></i></label>
                        </div>
                        @else
                        <button class="btn btn-default btn-xs col-md-12" data-toggle="modal" data-target=".edit-{{$payment->id}}"><i class="fa fa-pencil"></i> Edit</button>
                        @endif
                    </td>
                    <div class="input-group m-b col-md-12">
                        <input type="hidden" class="form-control" name="{{$payment->medId}}" value="{{$payment->drugId}}">
                    </div>
                </tr>
                <!-- Confirm cash Payment -->
                <div class="modal fade confirm-cash-{{$payment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk text-center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                Confirm Cash Payment</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 text-center">
                                        <p>Are you sure you want to confirm cash payment of <br><i class="fa fa-money"></i> <strong>Ksh. {{ $payment->cost }}</strong> for <strong>{{ $payment->patient }}</strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-light lt">
                                <button class="btn btn-default btn-sm pull-left"> Go Back</button>
                                {!!Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@confirmPayment',$payment->medId]])!!}
                                {!! Form::submit('Confirm Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        </div><!-- /. modal dialog -->
                        </div><!-- /. modal-->
                        <!-- Insure Payment -->
                        <div class="modal fade confirm-insurance-{{$payment->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-info dk text-center">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="blue bigger">
                                        Confirm Insurance Payment</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <p class="text-center">Are you sure you want to confirm <i class="fa fa-credit-card"></i> insurance payment of<br> <i class="fa fa-money"></i> <strong>Ksh. {{ $payment->cost }}</strong> for <strong>{{ $payment->patient }}</strong>?</p>
                                            </div>
                                            <div class="col-md-12">
                                                {!! Form::open(['method'=>'POST','url'=>'create-insurance','action'=>['Accounts\InsuranceController@createInsurance']])!!}
                                                <div class="form-group col-md-12">
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="provider" placeholder="Insurance Provider" required>
                                                    </div>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="text" class="form-control" name="insId" placeholder="Insurance ID. No." required>
                                                    </div>
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="hidden" class="form-control" name="medId" value="{{ $payment->medId }}" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <input type="hidden" class="form-control" name="id" value="{{ $payment->id }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light lt">
                                        <button class="btn btn-default btn-sm pull-left">Go Back</button>
                                        {!! Form::submit('Insure Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                </div><!-- /. modal dialog -->
                                </div><!-- /. modal-->
                                <!-- Confirm cash Payment -->
                                <!-- Edit Payment -->
                                <div class="modal fade edit-{{$payment->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info dk">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="blue bigger text-center">
                                                Edit Payment</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    {!! Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@updatePayment', $payment->id]])!!}
                                                    @if(($payment->status)==="Paid")
                                                    <div class="form-group col-md-11 col-md-offset-1">
                                                        <label>
                                                            Edit Payment Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="Paid" checked>
                                                                <i></i>
                                                                Paid
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="Not Paid">
                                                                <i></i>
                                                                Not Paid
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-md-11 col-md-offset-1">
                                                        <label>
                                                            Payment Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="Paid">
                                                                <i></i>
                                                                Paid
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="status" value="Not Paid" checked>
                                                                <i></i>
                                                                Not Paid
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if(($payment->insurance)==1)
                                                    <div class="form-group col-md-11 col-md-offset-1">
                                                        <label>
                                                            Update Insurance Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="insurance" value="1" checked>
                                                                <i></i>
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="insurance" value="0">
                                                                <i></i>
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="form-group col-md-11 col-md-offset-1">
                                                        <label>
                                                            Update Insurance Status:
                                                        </label>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="insurance" value="1">
                                                                <i></i>
                                                                Yes
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label class="i-checks">
                                                                <input type="radio" name="insurance" value="0" checked>
                                                                <i></i>
                                                                No
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="input-group m-b col-md-12">
                                                        <input type="hidden" class="form-control" name="updatedBy" placeholder="UpdatedBy"
                                                        value="{{ $user }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light lt">
                                                <button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Go Back</button>
                                                {!! Form::submit('Update Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
                                                {!!Form::close()!!}
                                            </div>
                                        </div>
                                        </div><!-- /. modal dialog -->
                                        </div><!-- /. modal-->
                                        <!-- Edit Payment -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <ul class="pagination">
                                    {{ $allpayments->links() }}
                                </ul>
                            </div>
                        </div>
                        @endif