@if (!empty($designation))
    {!! Form::model($designation, ['method' => 'PATCH','route' => ['designations.update', Crypt::Encrypt($designation->id)], 'id'=>'editDesignationForm']) !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editDesignationModalLabel">Edit Designation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="designation_name">Designation Name</label>
                    <input type="text" class="form-control" placeholder="Designation Name" name="designation_name" value="{{ old('designation_name', $designation->name) }}" aria-label="Designation Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label" for="editstatus">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ Form::checkbox('status', 1, ($designation->status == 1) ? true : false, array('class' => 'switch-input','id' => 'editstatus')) }}
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editDesignationSubmit">Save changes</button>
        </div>
    {!! Form::close() !!}
@endif
