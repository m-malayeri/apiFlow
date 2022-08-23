@if (Session::has('message'))
<div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
@endif

<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#decisionModal">New Decision</button>

<div class="modal fade" id="decisionModal" tabindex="-1" aria-labelledby="decisionModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="decisionModalLabel">New Decision</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('node')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>
						<input type="hidden" class="form-control" id="node_seq" name="node_seq" value="{{$maxSeq+1}}" required>

						<label for="node_type" class="col-form-label">Node Type</label>
						<input type="text" class="form-control" id="node_type" name="node_type" required>

						<label for="node_spec_id" class="col-form-label">Node Spec Id</label>
						<input type="text" class="form-control" id="node_spec_id" name="node_spec_id" required>
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
			<th scope="col">Decision Name</th>
			<th scope="col">Flow Node Id</th>
			<th scope="col">Property Name</th>
			<th scope="col">Decision Type</th>
			<th scope="col">Property Value</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($decisions as $decision)
		<tr>
			<th scope="row">{{$decision->id}}</th>
			<td>{{$decision->decision_name}}</td>
			<td>{{$decision->flow_node_id}}</td>
			<td>{{$decision->prop_name}}</td>
			<td>{{$decision->decision_type}}</td>
			<td>{{$decision->prop_value}}</td>
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