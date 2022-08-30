<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#invokeInputModal">New Input</button>

<div class="modal fade" id="invokeInputModal" tabindex="-1" aria-labelledby="invokeInputsModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="invokeInputsModalLabel">New Input</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('invokeInputs')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="invoke_id" class="col-form-label">Invoke Id</label>
						<input type="text" class="form-control" id="invoke_id" name="invoke_id" required>

						<label for="input_name" class="col-form-label">Input Name</label>
						<input type="text" class="form-control" id="input_name" name="input_name" required>

						<label for="input_type" class="form-label">Input Type</label>
						<select id="input_type" class="form-select" name="input_type">
							<option selected>User</option>
							<option>Literal</option>
						</select>

						<label for="literal_value" class="col-form-label">Literal Value</label>
						<input type="password" class="form-control" id="literal_value" name="literal_value">

						<label for="api_input_name" class="col-form-label">API Input Name</label>
						<input type="text" class="form-control" id="api_input_name" name="api_input_name">

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

@if(count($invokeInputs)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Invoke Id</th>
			<th scope="col">Input Name</th>
			<th scope="col">Input Type</th>
			<th scope="col">Literal Value</th>
			<th scope="col">API Input Name</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($invokeInputs as $invokeInput)
		<tr>
			<th scope="row">{{$invokeInput->id}}</th>
			<td>{{$invokeInput->invoke_id}}</td>
			<td>{{$invokeInput->input_name}}</td>
			<td>{{$invokeInput->input_type}}</td>
			<td>{{$invokeInput->literal_value}}</td>
			<td>{{$invokeInput->api_input_name}}</td>
			<td class="my-action-icons">
				<a href="{{url('invokeInput/delete/'.$invokeInput->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif