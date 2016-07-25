@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
</div>
@endif
@if(!$insurances)
<h5>Sorry, there are no insurances.</h5>
@else
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:20%">Ins. Id.</th>
                    <th style="width:20%">Patient</th>
                    <th style="width:10%">Cost</th>
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
                            <label aria-invalid="false" class="btn btn-xs btn-default" btn-checkbox="" data-toggle="modal" data-target=""><i class="fa fa-arrow-left"></i> Cash</label>
                            <label style="" aria-invalid="false" class="btn btn-xs btn-danger" btn-checkbox="" data-toggle="modal" data-target=".insurance-{{$insurance->id}}"> Delete </label>
                        </div>
                    </td>
                </tr>
                <div class="modal fade insurance-{{$insurance->id}}" tabindex="-1">
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
@endif