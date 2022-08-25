<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#actionModal">New Action</button>

<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="actionModalLabel">New Action</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('action')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="action_name" class="col-form-label">Action Name</label>
						<input type="text" class="form-control" id="action_name" name="action_name" required>


						<label for="action_type" class="form-label">Action Type</label>
						<select id="action_type" class="form-select" name="action_type">
							<option selected>Invoke</option>
						</select>

						<label for="action_spec_id" class="col-form-label">Action Spec Id</label>
						<input type="text" class="form-control" id="action_spec_id" name="action_spec_id" required>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@if(count($actions)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Action Name</th>
			<th scope="col">Action Type</th>
			<th scope="col">Action Spec Id</th>
			<th scope="col">Created At</th>
			<th scope="col">Updated At</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($actions as $action)
		<tr>
			<th scope="row">{{$action->id}}</th>
			<td>{{$action->action_name}}</td>
			<td>{{$action->action_type}}</td>
			<td>{{$action->action_spec_id}}</td>
			<td>{{$action->created_at}}</td>
			<td>{{$action->updated_at}}</td>
			<td class="my-action-icons">
				<a href="{{url('action/delete/'.$action->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif