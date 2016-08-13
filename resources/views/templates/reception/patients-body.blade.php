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
<<<<<<< HEAD
            <button class="btn btn-success rounded" type="submit">Search</button>
=======
            <button class="btn btn-info rounded" type="submit">Search</button>
>>>>>>> 049a58764b93aa02d74aceecd65663f5b5f0d074
          </span>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
