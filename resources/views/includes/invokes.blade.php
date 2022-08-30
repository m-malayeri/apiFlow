<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#invokeModal">New Invoke</button>

<div class="modal fade" id="invokeModal" tabindex="-1" aria-labelledby="invokeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="invokeModalLabel">New Invoke</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('invoke')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="flow_node_id" class="col-form-label">Flow Node Id</label>
						<input type="text" class="form-control" id="flow_node_id" name="flow_node_id" required>

						<label for="url" class="col-form-label">URL</label>
						<input type="text" class="form-control" id="url" name="url" required>

						<label for="method" class="form-label">Method</label>
						<select id="method" class="form-select" name="method">
							<option selected>POST</option>
							<option>GET</option>
						</select>

						<label for="content_type" class="form-label">Content Type</label>
						<select id="content_type" class="form-select" name="content_type">
							<option selected>application/json</option>
						</select>

						<label for="auth_type" class="form-label">Authentication Type</label>
						<select id="auth_type" class="form-select" name="auth_type">
							<option selected>Basic</option>
						</select>

						<label for="user" class="col-form-label">User</label>
						<input type="text" class="form-control" id="user" name="user">

						<label for="password" class="col-form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password">

						<label for="req_parent_object" class="col-form-label">Request Parent Object</label>
						<input type="text" class="form-control" id="req_parent_object" name="req_parent_object">

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

@if(count($invokes)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Node Id</th>
			<th scope="col">URL</th>
			<th scope="col">Method</th>
			<th scope="col">Content Type</th>
			<th scope="col">Auth Type</th>
			<th scope="col">REQ Parent Object</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($invokes as $invoke)
		<tr>
			<th scope="row">{{$invoke->id}}</th>
			<td>{{$invoke->flow_node_id}}</td>
			<td>{{$invoke->url}}</td>
			<td>{{$invoke->method}}</td>
			<td>{{$invoke->content_type}}</td>
			<td>{{$invoke->auth_type}}</td>
			<td>{{$invoke->req_parent_object}}</td>
			<td class="my-action-icons">
				<a href="{{url('invoke/delete/'.$invoke->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@if(isset($invokeInputs[$invoke->id]))
		<tr>
			<td colspan="5">
				<table class="table mb-0 my-nested-table">
					<thead>
						<tr>
							<th scope="col" rowspan="2"></th>
							<th scope="col">Input Name</th>
							<th scope="col">Input Type</th>
							<th scope="col">Literal Value</th>
							<th scope="col">API Input Name</th>
						</tr>
					</thead>
					<tbody>
						@php
						$invokeInputsArray = $invokeInputs->where('invoke_id', $invoke->id);
						@endphp
						@foreach($invokeInputsArray as $invokeInput)
						<tr>
							<th scope="row"></th>
							<td>{{$invokeInput->input_name}}</td>
							<td>{{$invokeInput->input_type}}</td>
							<td>{{$invokeInput->literal_value}}</td>
							<td>{{$invokeInput->api_input_name}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</td>
		</tr>
		@endif
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif