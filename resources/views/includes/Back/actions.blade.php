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
				<a href="{{url('action/show/'.$action->id)}}" title="Configuration"><i class="fa fa-search"></i></a>
				<a href="{{url('action/delete/'.$action->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif