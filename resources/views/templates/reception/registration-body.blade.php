<div class="wrapper-md">
  <div class="row col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading bg-primary text-left">Register a New Patient</div>
      <div class="panel-body">
      @if (Session::has('info'))
        <div class="alert alert-info text-center" role="alert">
          {{ Session::get('info') }}
        </div>
        @endif
        @if (count($errors) > 0)
                  <div class="alert alert-danger">
                  <strong>Whoops! Sorry!</strong> There were some problems with your input.<br>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  </div>
                  @endif

                  <!-- url="reception-registration" action="{{route('register-patient')}}" method="POST" class="form-horizontal form" role="form" -->
        <form role="form" url="reception-registration" action="{{route('register-patient')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="identification" placeholder="ID No. (i.e. National ID No. , Passport No. e.t.c)" required>
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="middleName" placeholder="Middle Name">
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="lastName" placeholder="Last Name">
        </div>
        <div class="form-group col-sm-12">
          <div class="input-group">
            <input type="text" class="form-control" name="dateOfBirth" datepicker-popup="" ng-model="dt" is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" placeholder="Date of Birth i.e. 11/11/1990" />
            <span class="input-group-btn">
              <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
            </span>
          </div>
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="estimatedAge" placeholder="or Estimated Age">
        </div>
        <div class="form-group col-md-12">
          <label>
            Gender:
          </label>
          <div class="radio">
            <label class="i-checks">
              <input type="radio" name="gender" value="Male">
              <i></i>
              Male
            </label>
          </div>
          <div class="radio">
            <label class="i-checks">
              <input type="radio" name="gender" value="Female">
              <i></i>
              Female
            </label>
          </div>
        </div>
        <div class="wrapper"></div>
        <div class="line b-b"></div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="residence" placeholder="Place of Residence">
        </div>
        <div class="form-group col-md-12">
          <input type="text" class="form-control" name="county" placeholder="County">
        </div>
        
        <div class="form-group col-md-12">
          <select ui-jq="chosen" class="w-full" name="countryOrigin">
            <optgroup label="Country">
              @include('templates.reception.select-countries')
            </optgroup>
          </select>
        </div>

        <div class="form-group col-md-12">
          <input type="phone" class="form-control" name="patientPhone" placeholder="Patient Phone">
        </div>
        <div class="form-group col-md-12">
          <input type="phone" class="form-control" name="kinPhone" placeholder="Next of Kin Phone">
        </div>
        <div class="form-group col-md-12">
          <input type="email" class="form-control" name="email" placeholder="Email Address">
        </div>
                <div class="wrapper"></div>
        <div class="line b-b"></div>
        
        
        <div class="form-group col-md-12">
          <button type="submit" class="form-control btn btn-sm btn-info text-center">Register New Patient</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>