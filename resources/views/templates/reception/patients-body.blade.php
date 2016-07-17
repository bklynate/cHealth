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
<div class="panel panel-default">
  <div class="panel-heading bg-light lt">
    Global Search
  </div>
  <div class="panel-body">
    {!! Form::open(array('route' => 'search')) !!}
    <div class="form-group">
      <div class="col-sm-12">
        <div class="input-group m-b">
          <input type="text" class="form-control rounded" name="search" placeholder="Search patient here..." required>
          <span class="input-group-btn">
            <button class="btn btn-info rounded" type="submit">Search</button>
          </span>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
