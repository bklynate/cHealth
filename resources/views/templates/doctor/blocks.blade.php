<div class="col-md-5">
          <div class="row row-sm text-center">
            
            <div class="col-xs-6">
              <a href="{{route('doctor-appointments')}}" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block">{{ count($appointments) }}</span>
                <span class="text-muted text-xs">Pending Appointments</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-file-text-o text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href="{{route('doctor-consultations')}}" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block"><i class="fa fa-stethoscope"></i></span>
                <span class="text-muted text-xs">Past Consultations</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-stethoscope text-muted m-r-sm"></i>
                </span>
              </a>
            </div>

            <div class="col-xs-6">
              <a href="" class="block panel padder-v bg-info item dker">
                <span class="text-white font-thin h1 block">5</span>
                <span class="text-muted text-xs">Today's Patients</span>
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