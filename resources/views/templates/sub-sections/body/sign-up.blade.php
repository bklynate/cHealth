<div class="col-md-5">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">Sign in below</div>
    <div class="panel-body">
      {!! Form::open(array(
      'url'     => '/',
      'action'  => 'route("home")',
      'method'  => 'POST',
      'role'    => 'form'
      ))
      !!}
      <div class="form-group">
        <input class="form-control" placeholder="Enter Username" type="text" name="username" required>
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Password" type="password" name="password" required>
      </div>
      <div class="checkbox">
        <label class="i-checks">
          <input type="checkbox" name="remember"><i></i> Remember me
        </label>
      </div>
      <div class="form-group">
        <!-- <input type="submit" href="" class="btn btn-success btn-md" value="Sign in"></input> -->
        <button type="submit" class="btn m-b-xs btn-success btn-addon btn-md pull-right">
        <i class="fa fa-plus"></i>
        Sign in
        </button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
  @if (Session::has('info'))
  <div class="alert alert-info text-center" role="alert">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('info') }}
  </div>
  @endif
  @if (count($errors) > 0)
  <div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Please try again and kindly take note that:
    <ol>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ol>
  </div>
  @endif
</div>