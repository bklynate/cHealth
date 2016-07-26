<!-- aside -->
<aside id="aside" class="app-aside hidden-xs bg-light">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="padder m-t m-b-sm text-muted">
            <button class="btn m-b-xs btn-success btn-addon">
            <i class="fa fa-search"></i>
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
              <b class="badge bg-danger pull-right">
              {{ count($dispensations) }}
              </b>
              @endif
            </a>
          </li>
          <li>
            <a href="{{route('pharmacy-inventory')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-database"></i>
              <span class="">Inventory</span>
            </a>
          </li>
          <li>
            <a href="{{route('pharmacy-refills')}}">
              <span class="pull-right text-muted">
              </span>
              <i class="fa fa-plus-circle"></i>
              <span class="">Refills</span>
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