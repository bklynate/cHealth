<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-light">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="padder m-t m-b-sm text-muted">
            <button class="btn m-b-xs btn-info btn-addon">
            <i class="fa fa-plus"></i>
            Search Drug
            </button>
          </li>
          <li>
            <a href="{{route('pharmacy-home')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-home"></i>
              <span class="">Home</span>
            </a>
          </li>
          <li>
            <a href="{{route('pharmacy-dispensations')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-file-text-o"></i>
              <span>Dispensations</span>
              @if(count($dispensations)>0)
              <b class="badge bg-info pull-right">
              {{ $appointments }}
              </b>
              @endif
            </a>
          </li>
          <li>
            <a href="{{route('medical-profile')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-stethoscope"></i>
              <span class="">Inventory</span>
            </a>
          </li>
          <!-- <li>
            <a href="{{route('doctor-consultations')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-database"></i>
              <span class="">Notifications</span>
            </a>
          </li> -->
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