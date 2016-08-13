<div class="col-md-5">
                                        <div class="row row-sm text-center">
                                            <div class="col-xs-6">
                                                @if($payments)
                                                    <a href="{{ route('accounts-payments') }}" class="block panel padder-v bg-danger item dk">
                                                        <span class="text-white font-thin h1 block">{{ count($payments) }}</span>
                                                        <span class="text-muted text-xs">Pending Payments</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('accounts-payments') }}" class="block panel padder-v bg-info item dker">
                                                    <span class="text-white font-thin h1 block">{{ count($payments) }}</span>
                                                    <span class="text-muted text-xs">Pending Payments</span>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="{{ route('accounts-services') }}" class="block panel padder-v bg-info item dker">
                                                    <span class="text-white font-thin h1 block"><i class="fa fa-minus"></i></span>
                                                    <span class="text-muted text-xs">Services</span>
                                                </a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="{{ route('accounts-insurance') }}" class="block panel padder-v bg-info item dker">
                                                    <span class="text-white font-thin h1 block"><i class="fa fa-credit-card"></i></span>
                                                    <span class="text-muted text-xs">Insurance</span>
                                                </a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="{{ route('accounts-reports') }}" class="block panel padder-v bg-info item dker">
                                                    <span class="text-white font-thin h1 block"><i class="fa fa-file-text-o"></i></span>
                                                    <span class="text-muted text-xs">Reports</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>