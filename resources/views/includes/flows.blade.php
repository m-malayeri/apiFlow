@if(count($flows)>0)
<table class="table table-striped table-hover table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Flow Name</th>
			<th scope="col">Status</th>
			<th scope="col">Log Level</th>
			<th scope="col">Created At</th>
			<th scope="col">Updated At</th>
			<th scope="col">Manage</th>
		</tr>
	</thead>
	<tbody>
		@foreach($flows as $flow)
		<tr>
			<th scope="row">{{$flow->id}}</th>
			<td>{{$flow->flow_name}}</td>
			<td>{{$flow->status}}</td>
			<td>{{$flow->log_level}}</td>
			<td>{{$flow->created_at}}</td>
			<td>{{$flow->updated_at}}</td>
			<td class="my-icons">
				<a href="{{url('node/'.$flow->id)}}" title="Configuration"><i class="fa fa-search"></i></a>
				@if($flow->status=="Enabled")
				<a href="{{url('flow/disable/'.$flow->id)}}" title="Disable"><i class="fa fa-eye-slash"></i></a>
				@else
				<a href="{{url('flow/enable/'.$flow->id)}}" title="Enable"><i class="fa fa fa-eye"></i></a>
				@endif
				<a href="{{url('flow/delete/'.$flow->id)}}"><i class="fa fa-remove"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
<div class="alert alert-warning" role="alert">No records</div>
@endif