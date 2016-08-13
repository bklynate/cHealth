<aside id="aside" class="app-aside hidden-xs bg-light">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="padder m-t m-b-sm text-muted">
                        <button class="btn m-b-xs btn-success btn-addon" data-toggle="modal" data-target=".search-payment">
                        <i class="fa fa-search"></i> Search Payment
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('accounts-home') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-home"></i>
                            <span class="">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accounts-payments') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-money"></i>
                            <span class="">Payments</span>
                            @if(count($payments)>0)
                            <b class="badge bg-danger dk pull-right">
                            {{ count($payments) }}
                            </b>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accounts-insurance') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-credit-card"></i>
                            <span class="">Insurance</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accounts-services') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-medkit" aria-hidden="true"></i>
                            <span class="">Services</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('accounts-reports') }}">
                            <span class="pull-right text-muted">
                            </span>
                            <i class="fa fa-file-text-o"></i>
                            <span class="">Reports</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
<!-- Search Payment Modal -->
<div class="modal fade search-payment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <h4 class="m-t-none m-b font-thin"><i class="fa fa-user"></i> Search for payment below: <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                        {!! Form::open(array('route' => 'search-payment')) !!}
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

        <!-- Search Payment Modal -->