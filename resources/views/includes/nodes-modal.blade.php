@if (Session::has('message'))
<div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
@endif

<button type="button" class="btn btn-primary my-flow-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">New Node</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Node</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('node')}}">
                    <div class="mb-3">
                        @csrf
                        <label for="flow_id" class="col-form-label">Flow Id</label>
                        <input type="text" class="form-control" id="flow_id" name="flow_id" required>

                        <label for="node_type" class="col-form-label">Node Type</label>
                        <input type="text" class="form-control" id="node_type" name="node_type" required>

                        <label for="node_seq" class="col-form-label">Node Sequence</label>
                        <input type="text" class="form-control" id="node_seq" name="node_seq" required>

                        <label for="node_spec_id" class="col-form-label">Node Spec Id</label>
                        <input type="text" class="form-control" id="node_spec_id" name="node_spec_id" required>
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