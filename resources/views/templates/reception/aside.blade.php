<aside id="aside" class="app-aside hidden-xs bg-light">
                <div class="aside-wrap">
                    <div class="navi-wrap">
                        <!-- nav -->
                        <nav ui-nav class="navi clearfix">
                            <ul class="nav">
                                <br><a class="padder m-t m-b-sm text-muted">
                                    <button class="btn m-b-xs btn-success btn-addon">
                                    <i class="fa fa-search"></i> Search Patients
                                    </button>
                                </a>
                                <li>
                                    <a href="{{ route('reception-home') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-home"></i>
                                        <span class="">Home</span>
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
                                <!-- <li>
                                    <a href="{{ route('reception-calendar') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-calendar"></i>
                                        <span class="">Calendar</span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="{{ route('reception-appointments') }}">
                                        <span class="pull-right text-muted">
                                        </span>
                                        <i class="fa fa-file-text-o"></i>
                                        <span class="">Appointments</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- nav -->
                    </div>
                </div>
            </aside>