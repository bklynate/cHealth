@if(count($insurances===0))
<h5>Sorry, there are no insurances.</h5>
@else
<div class="panel panel-default">
    <div class="panel-heading">
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-responsive">
            
            <thead>
                <tr>
                    <th style="width:10%">Med Id.</th>
                    <th style="width:15%">Patient</th>
                    <th style="width:15%">Doctor</th>
                    <th style="width:15%">Service</th>
                    <th style="width:10%">Cost</th>
                    <th style="width:15%">Provider</th>
                    <th style="width:15%">Created By</th>
                    <th style="width:10%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insurances->reverse() as $insurance)
                <tr>
                    <td>
                        {{ $insurance->name }}
                    </td>
                    <td>
                        {{ $insurance->cost }}
                    </td>
                    <td>
                        {{ $insurance->status }}
                    </td>
                    <td>
                        {{ $insurance->createdBy }}
                    </td>
                    <td class="center">
                        <a href="">
                            Edit <i class="fa fa-pencil text-center"></i>
                        </a> /
                        <a data-toggle="modal" data-target=".insurance-{{$insurance->id}}">
                            Cancel <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <div class="modal fade insurance-{{$insurance->id}}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h5 class="blue bigger">
                                <i class="fa fa-trash"></i>
                                Please, Confirm to cancel this insurance?</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <p>Are you sure you want to <b>Permanently</b> cancel this insurance?</p>
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
                    {{ $insurances->links() }}
                </ul>
            </div>
        </div>
@endif