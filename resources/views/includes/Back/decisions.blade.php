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
				<th scope="col">Created At</th>
				<th scope="col">Updated At</th>
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
					<td>{{$decision->created_at}}</td>
					<td>{{$decision->updated_at}}</td>
					<td class="my-decision-icons">
						<a href="{{url('decision/show/'.$decision->id)}}" title="Configuration"><i class="fa fa-search"></i></a>
						<a href="{{url('decision/delete/'.$decision->id)}}"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-warning" role="alert">No records</div>
@endif