<div class="accordion accordion-flush" id="accordionFlush">
	@if(count($flows)>0)
		@foreach($flows as $flow)
			<div class="accordion-item">
				<h2 class="accordion-header" id="flush-heading{{$flow->id}}">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$flow->id}}" aria-expanded="false" aria-controls="flush-collapse{{$flow->id}}">
						#{{$flow->id}} - {{$flow->flow_name}} - {{$flow->created_at}}	
					</button>
				</h2>
				<div id="flush-collapse{{$flow->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$flow->id}}" data-bs-parent="#accordionFlush">
					<div class="accordion-body">
						@include('includes.flowNodes')
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="alert alert-warning" role="alert">No records</div>
	@endif
</div>