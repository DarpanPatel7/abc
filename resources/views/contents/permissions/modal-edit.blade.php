@if (!empty($permission))
    {!! Form::model($designation, [
        'method' => 'PATCH',
        'route' => ['permissions.update', Crypt::Encrypt($permission->id)],
        'id' => 'editPermissionForm',
    ]) !!}
    <form id="editPermissionForm" class="row" onsubmit="return false">
        <div class="col-sm-9">
            <label class="form-label" for="permission_name">Permission Name</label>
            <input type="text" name="permission_name" class="form-control" placeholder="Permission Name" tabindex="-1" />
        </div>
        <div class="col-sm-3 mb-3">
            <label class="form-label invisible d-none d-sm-inline-block">Button</label>
            <button type="submit" class="btn btn-primary mt-1 mt-sm-0" id="editPermissionSubmit">Update</button>
        </div>
        {{--  <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editCorePermission" />
                <label class="form-check-label" for="editCorePermission">
                    Set as core permission
                </label>
            </div>
        </div>  --}}
    </form>
    {!! Form::close() !!}
@endif
