<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#connectorModal">New Connector</button>

<div class="modal fade" id="connectorModal" tabindex="-1" aria-labelledby="connectorModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="connectorModalLabel">New Connector</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('connector')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="src_type" class="col-form-label">Source Type</label>
						<select id="src_type" class="form-select" name="src_type" required>
							<option selected>Start</option>
							<option>Invoke</option>
							<option>Decision</option>
							<option>End</option>
						</select>

						<label for="src_id" class="col-form-label">Source Node Id</label>
						<input type="text" class="form-control" id="src_id" name="src_id" required>

						<label for="target_type" class="col-form-label">Target Type</label>
						<select id="target_type" class="form-select" name="target_type" required>
							<option selected>Start</option>
							<option>Invoke</option>
							<option>Decision</option>
							<option>End</option>
						</select>

						<label for="target_id" class="col-form-label">Target Node Id</label>
						<input type="text" class="form-control" id="target_id" name="target_id" required>

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

@if(count($connectors)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Source Type</th>
			<th scope="col">Source Node Id</th>
			<th scope="col">Target Type</th>
			<th scope="col">Target Node Id</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($connectors as $connector)
		<tr>
			<th scope="row">{{$connector->id}}</th>
			<td>{{$connector->src_type}}</td>
			<td>{{$connector->src_id}}</td>
			<td>{{$connector->target_type}}</td>
			<td>{{$connector->target_id}}</td>
			<td class="my-decision-icons">
				<a href="{{url('connector/delete/'.$connector->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif