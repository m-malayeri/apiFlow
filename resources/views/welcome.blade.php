@extends('layouts.landing')

@section('content')
<section class="main-section">
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')
            <div class="col-md-10 main">
                <ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="flows-tab" data-bs-toggle="tab" data-bs-target="#flows" type="button" role="tab" aria-controls="flows" aria-selected="true">Flows</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab" aria-controls="logs" aria-selected="false">API Logs</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#sessions" type="button" role="tab" aria-controls="sessions" aria-selected="false">Sessions</button>
                    </li>
                </ul>
                <div class="tab-content my-tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="flows" role="tabpanel" aria-labelledby="flows-tab">
                        @include('includes.flows-modal')
                        @include('includes.flows')
                    </div>
                    <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                        @include('includes.logs')
                    </div>
                    <div class="tab-pane fade" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
                        @include('includes.sessions')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection