@if (!empty($employee))
    <!-- Update role form -->
    {!! Form::model($employee, [
        'method' => 'PATCH',
        'route' => ['roles.updateRole', Crypt::Encrypt($employee->id)],
        'id' => 'assignRoleForm',
        'class' => 'restrict-enter row g-3 fv-plugins-bootstrap5 fv-plugins-framework w-100',
    ]) !!}
        <div class="modal-content dropdownParent p-3 p-md-5 mt-0">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Assign Role</h3>
                </div>
                <div class="col-12 mb-4 inp-group">
                    <label for="assignRoleMultiple" class="form-label">Roles</label>
                    {!! Form::select('roles[]', $roles, $employeeRole, [
                        'class' => 'select2 form-select',
                        'id' => 'assignRoleMultiple',
                        'multiple' => 'multiple',
                        'data-placeholder' => 'Select Roles'
                    ]) !!}
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" id="assignRoleSubmit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    <!--/ Update role form -->
@endif
