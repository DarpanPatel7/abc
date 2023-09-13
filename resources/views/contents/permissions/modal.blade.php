@if (Route::is(['permissions.index']))
    <!-- add permission -->
    <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3>Add New Permission</h3>
                        <p>Permissions you may user and assign to your users.</p>
                    </div>
                    {!! Form::open([
                        'route' => 'permissions.store',
                        'method' => 'POST',
                        'id' => 'addPermissionForm',
                        'class' => 'restrict-enter',
                    ]) !!}
                    <div class="col-12 mb-3">
                        <label class="form-label" for="permission_name">Permission Name</label>
                        <input type="text" name="permission_name" class="form-control" placeholder="Permission Name"
                            autofocus />
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="corePermission" />
                            <label class="form-check-label" for="corePermission">
                                Set as core permission
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" id="addPermissionSubmit">Create
                            Permission</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Discard</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- add permission -->

    <!-- edit permission -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3>Edit Permission</h3>
                        <p>Edit permission as per your requirements.</p>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading mb-2">Warning</h6>
                        <p class="mb-0">By editing the permission name, you might break the system permissions
                            functionality. Please ensure you're absolutely certain before proceeding.</p>
                    </div>
                    <div id="editPermissionContent"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit permission -->
@endif
