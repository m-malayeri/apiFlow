@if(count($flows)>0)
	<table class="table table-striped table-hover table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Flow Name</th>
				<th scope="col">Created At</th>
				<th scope="col">Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach($flows as $flow)
				<tr>
					<th scope="row">{{$flow->id}}</th>
					<td>{{$flow->flow_name}}</td>
					<td>{{$flow->created_at}}</td>
					<td>{{$flow->updated_at}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-warning" role="alert">No records</div>
@endif