<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#decisionModal">New Decision</button>

<div class="modal fade" id="decisionModal" tabindex="-1" aria-labelledby="decisionModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="decisionModalLabel">New Decision</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('decision')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="prop_name" class="col-form-label">Property Name</label>
						<input type="text" class="form-control" id="prop_name" name="prop_name" required>

						<label for="decision_type" class="form-label">Decision Typ</label>
						<select id="decision_type" class="form-select" name="decision_type">
							<option selected>Equal</option>
							<option>Not Equal</option>
							<option>Greater Than</option>
							<option>Less Than</option>
						</select>

						<label for="prop_value" class="col-form-label">Property Value</label>
						<input type="text" class="form-control" id="prop_value" name="prop_value" required>

						<label for="next_node_id" class="col-form-label">Next Node Id</label>
						<input type="text" class="form-control" id="next_node_id" name="next_node_id" required>

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

@if(count($decisions)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Property Name</th>
			<th scope="col">Decision Type</th>
			<th scope="col">Property Value</th>
			<th scope="col">Next Node Id</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($decisions as $decision)
		<tr>
			<th scope="row">{{$decision->id}}</th>
			<td>{{$decision->prop_name}}</td>
			<td>{{$decision->decision_type}}</td>
			<td>{{$decision->prop_value}}</td>
			<td>{{$decision->next_node_id}}</td>
			<td class="my-decision-icons">
				<a href="{{url('decision/delete/'.$decision->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif