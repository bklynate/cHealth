<aside id="aside" class="app-aside hidden-xs bg-light">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="padder m-t m-b-sm text-muted">
                        <button class="btn m-b-xs btn-info btn-addon" data-toggle="modal" data-target=".search-patient">
                        <i class="fa fa-search"></i> Search Patients
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('reception-home') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-home"></i>
                            <span class="">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-appointments') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-file-text-o"></i>
                            <span class="">Appointments</span>
                            @if(count($appointments)>0)
                            <b class="badge bg-info pull-right">
                            {{ $appointments }}
                            </b>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-patients') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-users"></i>
                            <span class="">Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-registration') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-pencil"></i>
                            <span class="">Registration</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reception-doctors') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-user-md"></i>
                            <span class="">Staff</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
<div class="modal fade search-patient" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h4 class="m-t-none m-b font-thin"><i class="fa fa-user"></i> Search for a patient below: <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                        {!! Form::open(array('route' => 'search')) !!}
                        <div class="form-group">
                            <div class="input-group m-b">
                                <input type="text" class="form-control rounded" placeholder="Search here..." required>
                                <span class="input-group-btn">
                                    <button class="btn btn-info rounded" type="submit"><i class="fa fa-search"></i> Search</button>
                                </span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        </div><!-- /. modal dialog -->
        </div><!-- /. modal-->