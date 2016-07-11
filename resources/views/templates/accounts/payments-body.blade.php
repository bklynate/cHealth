@if(count($payments===0))
<h5>Sorry, there are no payments.</h5>
@else
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:10%">Med Id.</th>
                    <th style="width:20%">Patient</th>
                    <th style="width:15%">Status</th>
                    <th style="width:15%">Cost</th>
                    <th style="width:15%">Service</th>
                    <th style="width:15%">Received by</th>
                    <th style="width:10%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments->reverse() as $payment)
                <tr>
                    <td>
                        {{ $payment->medId }}
                    </td>
                    <td>
                        {{ $payment->patient }}
                    </td>
                    <td>
                        <button class="btn btn-xs btn-info">{{ $payment->status }} <i class="fa fa-money"></i></button
                    </td>
                    <td>
                        {{ $payment->cost }}
                    </td>
                    <td>
                        {{ $payment->serviceType }}
                    </td>
                    <td>
                        {{ $payment->receivedBy }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($payment->created_at)->diffForHumans() }}
                    </td>
                    <td class="center">
                        <a href="">
                            Edit <i class="fa fa-pencil text-center"></i>
                        </a> /
                        <a data-toggle="modal" data-target=".payment-{{$payment->id}}">
                            Cancel <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <div class="modal fade payment-{{$payment->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this payment?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this payment?</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
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
                    {{ $payments->links() }}
                </ul>
            </div>
        </div>
@endif