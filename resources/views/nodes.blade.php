@extends('layouts.landing')

@section('content')
<section class="main-section">
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')
            <div class="col-md-10 main">
                <ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="nodes-tab" data-bs-toggle="tab" data-bs-target="#nodes" type="button" role="tab" aria-controls="nodes" aria-selected="true">Nodes</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="actions-tab" data-bs-toggle="tab" data-bs-target="#actions" type="button" role="tab" aria-controls="actions" aria-selected="false">Actions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="decisions-tab" data-bs-toggle="tab" data-bs-target="#decisions" type="button" role="tab" aria-controls="decisions" aria-selected="false">Decisions</button>
                    </li>
                </ul>
                <div class="tab-content my-tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="flows" role="tabpanel" aria-labelledby="nodes-tab">
                        @include('includes.nodes-modal')
                        @include('includes.nodes')
                    </div>
                    <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="actions-tab">

                    </div>
                    <div class="tab-pane fade" id="sessions" role="tabpanel" aria-labelledby="decisions-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection