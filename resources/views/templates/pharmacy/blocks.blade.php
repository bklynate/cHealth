<div class="col-md-5">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
            @if($dispensationsCount>0)
              <a href="{{route('pharmacy-dispensations')}}" class="block panel padder-v bg-danger item dker">
                <span class="text-white font-thin h1 block">{{ $dispensationsCount }}</span>
                <span class="text-muted text-xs">Dispensations</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-file-text-o text-muted m-r-sm"></i>
                </span>
              </a>
              @else
                <a href="{{route('doctor-appointments')}}" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block">{{ $dispensationsCount }}</span>
                <span class="text-muted text-xs">Dispensations</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-file-text-o text-muted m-r-sm"></i>
                </span>
              </a>
              @endif
            </div>
            <div class="col-xs-6">
              <a href="{{route('pharmacy-inventory')}}" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-stethoscope"></i></span>
                <span class="text-muted text-xs">Inventory</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-database text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href="" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block">5</span>
                <span class="text-muted text-xs">Notifications</span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href="" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-user"></i></span>
                <span class="text-muted text-xs">My Profile</span>
              </a>
            </div>
          </div>
        </div>