@extends('layouts.landing')

@section('content')
<section class="main-section">
    <div class="container-fluid">
        <div class="row my-main-padding">
            @include('includes.sidebar')
            <div class="col-md-10 main">
                <div class="card border-primary mb-3" style="max-width: 400px;">
                    <div class="card-header">Flow Name</div>
                    <div class="card-body text-primary">
                        <h5 class="card-title">{{$flowDetails->flow_name}}</h5>
                    </div>
                </div>
                <ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nodes-tab" data-bs-toggle="tab" data-bs-target="#nodes" type="button" role="tab" aria-controls="nodes" aria-selected="true">Nodes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="invokes-tab" data-bs-toggle="tab" data-bs-target="#invokes" type="button" role="tab" aria-controls="invokes" aria-selected="false">Invokes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="decisions-tab" data-bs-toggle="tab" data-bs-target="#decisions" type="button" role="tab" aria-controls="decisions" aria-selected="false">Decisions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="connectors-tab" data-bs-toggle="tab" data-bs-target="#connectors" type="button" role="tab" aria-controls="connectors" aria-selected="false">Connectors</button>
                    </li>
                </ul>
                <div class="tab-content my-tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="nodes" role="tabpanel" aria-labelledby="nodes-tab">
                        @include('includes.nodes')
                    </div>
                    <div class="tab-pane fade" id="invokes" role="tabpanel" aria-labelledby="invokes-tab">
                        @include('includes.invokes')
                    </div>
                    <div class="tab-pane fade" id="decisions" role="tabpanel" aria-labelledby="decisions-tab">
                        @include('includes.decisions')
                    </div>
                    <div class="tab-pane fade" id="connectors" role="tabpanel" aria-labelledby="connectors-tab">
                        @include('includes.connectors')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection