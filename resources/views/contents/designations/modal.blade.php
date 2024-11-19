@if(Route::is(['designations.index']))
<!-- add designation -->
<div class="modal fade" id="addDesignationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! html()->form('POST')->route('designations.store')->id('addDesignationForm')->class('restrict-enter')->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addDesignationModalLabel">Add Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="designation_name">Designation Name</label>
                            <input type="text" class="form-control" placeholder="Designation Name" name="designation_name" aria-label="Designation Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="addstatus">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ html()->checkbox('status', true, 1)->id('addstatus')->class('switch-input') }}
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
                    <button type="button" class="btn btn-primary" id="addDesignationSubmit">Save changes</button>
                </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>

<!-- edit designation -->
<div class="modal fade" id="editDesignationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="editDesignationContent"></div>
        </div>
    </div>
</div>
@endif
