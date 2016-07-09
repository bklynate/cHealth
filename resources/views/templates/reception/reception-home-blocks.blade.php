<div class="col-md-5">
                                    <div class="row row-sm text-center">
                                        <div class="col-xs-6">
                                            <a href="{{ route('reception-patients') }}" class="block panel padder-v bg-info item dker">
                                                <span class="text-white font-thin h1 block"><i class="fa fa-users"></i></span>
                                                <span class="text-muted text-xs">Patients</span>
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{{ route('reception-registration') }}" class="block panel padder-v bg-info item dker">
                                                <span class="text-white font-thin h1 block"><i class="fa fa-pencil"></i></span>
                                                <span class="text-muted text-xs">Registration</span>
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{{ route('reception-calendar') }}" class="block panel padder-v bg-info item dker">
                                                <span class="text-white font-thin h1 block"><i class="fa fa-calendar"></i></span>
                                                <span class="text-muted text-xs">Calender</span>
                                            </a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="{{ route('reception-appointments') }}" class="block panel padder-v bg-info item dker">
                                                <span class="text-white font-thin h1 block">
                                                {{$appointments}}</span>
                                                <span class="text-muted text-xs">Appointments</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>