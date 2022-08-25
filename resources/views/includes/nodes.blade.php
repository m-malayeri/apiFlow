@if (Session::has('message'))
<div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
@endif

<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#nodeModal">New Node</button>

<div class="modal fade" id="nodeModal" tabindex="-1" aria-labelledby="nodeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="nodeModalLabel">New Node</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('node')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>
						<input type="hidden" class="form-control" id="node_seq" name="node_seq" value="{{$maxSeq+1}}" required>

						<label for="node_type" class="form-label">Node Type</label>
						<select id="node_type" class="form-select" name="node_type">
							<option selected>Action</option>
							<option>Decision</option>
						</select>

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

@if(count($flowNodes)>0)
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Flow Id</th>
			<th scope="col">Node Type</th>
			<th scope="col">Node Seq</th>
			<th scope="col">Node Spec Id</th>
			<th scope="col">Created At</th>
			<th scope="col">Updated At</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($flowNodes as $flowNode)
		<tr>
			<th scope="row">{{$flowNode->id}}</th>
			<td>{{$flowNode->flow_id}}</td>
			<td>{{$flowNode->node_type}}</td>
			<td>{{$flowNode->node_seq}}</td>
			<td>{{$flowNode->node_spec_id}}</td>
			<td>{{$flowNode->created_at}}</td>
			<td>{{$flowNode->updated_at}}</td>
			<td class="my-icons">
				<a href="{{url('node/delete/'.$flowNode->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif