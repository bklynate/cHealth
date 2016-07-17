<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-light">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="padder m-t m-b-sm text-muted">
            <button class="btn m-b-xs btn-info btn-addon">
            <i class="fa fa-calendar"></i>
            Appointments
            </button>
          </li>
          <li>
            <a href="{{route('doctor-home')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-home"></i>
              <span class="">Home</span>
            </a>
          </li>
          <li>
            <a href="{{route('doctor-appointments')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-file-text-o"></i>
              <span>Appointments</span>
              @if(count($appointments)!=0)
                <b class="badge bg-info pull-right"> 
                  {{ count($appointments) }}
                </b>
              @endif
            </a>
          </li>
          <li>
            <a href="{{route('medical-profile')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-stethoscope"></i>
              <span class="">Consultation</span>
            </a>
          </li>
          <li>
            <a href="{{route('doctor-consultations')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-database"></i>
              <span class="">History</span>
            </a>
          </li>
          <!-- <li>
            <a href="{{route('doctor-calendar')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-calendar"></i>
              <span class="">Calendar</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- nav -->
    </div>
  </div>
</aside>
<!-- / aside -->