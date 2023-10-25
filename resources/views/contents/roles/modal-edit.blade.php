@if (!empty($role))
    <!-- Edit role form -->
    {!! Form::model($role, [
        'method' => 'PATCH',
        'route' => ['roles.update', Crypt::Encrypt($role->id)],
        'id' => 'editRoleForm',
        'class' => 'restrict-enter row g-3 fv-plugins-bootstrap5 fv-plugins-framework w-100',
    ]) !!}
        <div class="modal-content p-3 p-md-5 mt-0">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="role-title">Edit Role</h3>
                    <p>Set role permissions</p>
                </div>
                <div class="col-12 mb-4 inp-group">
                    <label class="form-label" for="role_name">Role Name</label>
                    <input type="text" id="role_name" name="role_name" value="{{ old('name', $role->name) }}" class="form-control"
                        placeholder="Enter a role name" tabindex="-1" />
                </div>
                <div class="col-12">
                    <h5>Role Permissions</h5>
                    <!-- Permission table -->
                    <div class="table-responsive">
                        <table class="table table-flush-spacing">
                            <tbody>
                                <tr>
                                    <td class="text-nowrap">Administrator Access <i class="bx bx-info-circle bx-xs"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Allows a full access to the system"></i></td>
                                    <td>
                                        <div class="form-check">
                                            {{ Form::checkbox('all_permissions', null, false, ['class' => 'form-check-input', 'id' => 'addall_permissions']) }}
                                            <label class="form-check-label" for="addall_permissions">
                                                Select All
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @if (!empty($module_permissions))
                                    @foreach ($module_permissions as $pkey => $pval)
                                        @php
                                            $sr_pkey = str_replace(' ', '-', $pkey);

                                        @endphp
                                        <tr>
                                            <td class="text-nowrap">{{ $pkey }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($pval as $key => $val)
                                                        <div class="form-check me-3 me-lg-5">
                                                            {{ Form::checkbox('permission[]', $val->id, in_array($val->id, $rolePermissions) ? true : false, ['class' => 'form-check-input editpermission ' . $sr_pkey, 'data-val' => $sr_pkey, 'data-type' => $val->name, 'id' => 'editpermission' . $val->id]) }}
                                                            <label class="form-check-label" for="editpermission{{ $val->id }}">
                                                                {{ ucwords(str_replace('-', ' ', $val->name)) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Permission table -->
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" id="editRoleSubmit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    <!--/ Edit role form -->
@endif
