@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
@if(count($payments)===0)
<h5>Sorry, there are no pending payments.</h5>
@else
<div class="panel panel-default">
    <div class="panel-heading">
        {!! Form::open(array('route' => 'search-services', 'class'=>'form-inline text-right')) !!}
        <div class="form-group">
            <div class="input-group">
                <input placeholder="Search payments" name="search" class="form-control" type="text" required>
                <div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            <thead>
                <tr>
                    <th style="width:10%">Med Id.</th>
                    <th style="width:20%">Patient Name</th>
                    <th style="width:10%">Status</th>
                    <th style="width:15%">Service</th>
                    <th style="width:12%">Cost</th>
                    <th style="width:15%">Created on</th>
                    <th class="text-center" style="width:15%">Options</th>
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
                    <td>
                        <span class="text-info">{{ $payment->status }}</i></span>
                    </td>
                    <td>
                        {{ $payment->serviceType }}
                    </td>
                    <td>
                        Ksh. {{ $payment->cost }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($payment->created_at)->diffForHumans() }}
                    </td>
                    <td class="center">
                        @if(($payment->status)==="Not Paid")
                            <button class="btn btn-success btn-xs" data-toggle="modal" data-target=".confirm-{{$payment->id}}"><i class="fa fa-check"></i> Confirm Payment</button>
                        @else
                            <button class="btn btn-default btn-xs" data-toggle="modal" data-target=".confirm-{{$payment->id}}"><i class="fa fa-pencil"></i> Edit Payment</button>
                        @endif
                    </td>
                </tr>
                <!-- Confirm Payment -->
                <div class="modal fade confirm-{{$payment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-info dk">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-check"></i>
                                Confirm Payment</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to confirm payment for <strong>{{ $payment->patient }}</strong>?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default btn-sm pull-left"><i class="fa fa-arrow-left"></i> No, Go Back</button>
                                {!!Form::open(['method'=>'PUT','action'=>['Accounts\AccountsController@confirmPayment',$payment->medId]])!!}
                                {!! Form::submit('Confirm Payment', ['class' => 'btn btn-success btn-sm pull-right']) !!}
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
                            {{ $allpayments->links() }}
                        </ul>
                    </div>
                </div>
                @endif