@if (Session::has('message'))
<div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
@endif

<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">New Flow</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Flow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('flow')}}">
                    <div class="mb-3">
                        @csrf
                        <label for="flow_name" class="col-form-label">Flow Name</label>
                        <input type="text" class="form-control" id="flow_name" name="flow_name" required>

                        <label for="log_level" class="form-label">Log Level</label>
                        <select id="log_level" class="form-select" name="log_level">
                            <option selected>All</option>
                            <option>Property</option>
                            <option>Session</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>