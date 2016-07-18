@if (Session::has('info'))
<div class="alert alert-info text-center btn-close" role="alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{ Session::get('info') }}
</div>
@endif
<div class="panel panel-default">
	<div class="panel-heading">
		{!! Form::open(array('route' => 'search-services', 'class'=>'form-inline text-right')) !!}
		<div class="form-group">
			<div class="input-group">
				<input placeholder="Search Doctors" name="search" class="form-control" type="text" required>
				<div class="input-group-btn"><button class="btn btn-info" type="submit">Search</button></div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-responsive">
			
			<thead>
				<tr>
					<th style="width:40%">Staff Name</th>
					<th style="width:30%">Role</th>
					<th style="width:30%">Status</th>
				</tr>
			</thead>
			<tbody>
				
				@foreach($doctors as $doctor)
				<tr>
					<td>{{$doctor->fullname}}
					</td>
					<td>{{ $doctor->user_id}}
					</td>
					<td>
					</td>
					<td>
					</td>
					<td class="text-center">
						
					</td>
				</tr>
				
				@endforeach
			</tbody>
		</table>
	</div>
</tbody>
</table>
</div>
<div class="text-center">
<ul class="pagination">
{{ $doctors->links() }}
</ul>
</div>
</div>