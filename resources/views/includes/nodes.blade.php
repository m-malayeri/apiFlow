@if(count($nodes)>0)
<table class="table table-striped table-hover table-striped">
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
		@foreach($nodes as $node)
		<tr>
			<th scope="row">{{$node->id}}</th>
			<td>{{$node->flow_id}}</td>
			<td>{{$node->node_type}}</td>
			<td>{{$node->node_seq}}</td>
			<td>{{$node->node_spec_id}}</td>
			<td>{{$node->created_at}}</td>
			<td>{{$node->updated_at}}</td>
			<td class="my-icons">
				<a href="{{url('node/show/'.$node->id)}}" title="Configuration"><i class="fa fa-search"></i></a>
				<a href="{{url('node/delete/'.$node->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif