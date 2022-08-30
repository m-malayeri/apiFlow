<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#invokeOutputModal">New Output</button>

<div class="modal fade" id="invokeOutputModal" tabindex="-1" aria-labelledby="invokeOutoutModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="invokeOutoutModalLabel">New Output</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="post" action="{{url('invokeOutput')}}">
					<div class="mb-3">
						@csrf
						<input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flowDetails->id}}" required>

						<label for="invoke_id" class="col-form-label">Invoke Id</label>
						<input type="text" class="form-control" id="invoke_id" name="invoke_id" required>

						<label for="output_name" class="col-form-label">Output Name</label>
						<input type="text" class="form-control" id="output_name" name="output_name" required>

						<label for="save_as_prop_name" class="col-form-label">Save as Prop Name</label>
						<input type="text" class="form-control" id="save_as_prop_name" name="save_as_prop_name" required>

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

@if(count($invokeOutputs)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Invoke Id</th>
			<th scope="col">Output Name</th>
			<th scope="col">Save as Prop Name</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($invokeOutputs as $invokeOutput)
		<tr>
			<th scope="row">{{$invokeOutput->id}}</th>
			<td>{{$invokeOutput->invoke_id}}</td>
			<td>{{$invokeOutput->output_name}}</td>
			<td>{{$invokeOutput->save_as_prop_name}}</td>
			<td class="my-action-icons">
				<a href="{{url('invoke/delete/'.$invokeOutput->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif