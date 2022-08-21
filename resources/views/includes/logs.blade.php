@if(count($logs)>0)
	<table class="table table-striped table-hover table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Session Id</th>
				<th scope="col">Endpoint</th>
				<th scope="col">Request Timestamp</th>
				<th scope="col">Response Timestamp</th>
				<th scope="col">Duration(Ms)</th>
				<!-- <th scope="col">REQ</th> -->
				<!-- <th scope="col">RSP</th> -->
				<th scope="col">Created At</th>
				<th scope="col">Updated At</th>
			</tr>
		</thead>
		<tbody>
			@foreach($logs as $log)
				<tr>
					<th scope="row">{{$log->id}}</th>
					<td>{{$log->session_id}}</td>
					<td>{{$log->endpoint}}</td>
					<td>{{$log->req_timestamp}}</td>
					<td>{{$log->rsp_timestamp}}</td>
					<td>{{$log->duration}}</td>
					<!-- <td>{{$log->req}}</td> -->
					<!-- <td>{{$log->rsp}}</td> -->
					<td>{{$log->created_at}}</td>
					<td>{{$log->updated_at}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-warning" role="alert">No records</div>
@endif