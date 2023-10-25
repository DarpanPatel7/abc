@if (!empty($employee))
    <!-- Update role form -->
    {!! Form::model($role, [
        'method' => 'PATCH',
        'route' => ['roles.updateRole', Crypt::Encrypt($role->id)],
        'id' => 'assignRoleForm',
        'class' => 'restrict-enter row g-3',
    ]) !!}
    <div class="col-12 mb-4 inp-group">
        <label class="form-label" for="role_name">Role Name</label>
        <input type="text" id="role_name" name="role_name" value="{{ old('name', $role->name) }}" class="form-control"
            placeholder="Enter a role name" tabindex="-1" />
    </div>
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1" id="assignRoleSubmit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
            aria-label="Close">Cancel</button>
    </div>
    {!! Form::close() !!}
    <!--/ Update role form -->
@endif
