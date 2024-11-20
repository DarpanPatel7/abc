@if (!empty($role))
    <!-- Edit role form -->
    {!! html()->modelForm($role)->method('PATCH')->route('roles.update', Crypt::Encrypt($role->id))->id('editRoleForm')->class('restrict-enter row g-3 fv-plugins-bootstrap5 fv-plugins-framework w-100')->open() !!}
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
                                            {{
                                                html()->checkbox('all_permissions', false, null)
                                                ->id('editall_permissions')
                                                ->class('form-check-input')
                                            }}
                                            <label class="form-check-label" for="editall_permissions">
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
                                            <td>
                                                <div class="d-flex flex-wrap">
                                                    <div class="form-check me-3 me-lg-5">
                                                        {{
                                                            html()->checkbox('module_all_permissions', false, null)
                                                            ->id('editmodule_all_permissions' . $sr_pkey)
                                                            ->class('form-check-input editmodule_all_permissions')
                                                            ->attribute('data-key', $sr_pkey)
                                                        }}
                                                        <label class="form-check-label" for="editmodule_all_permissions{{ $sr_pkey }}">
                                                            {{ $pkey }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($pval as $key => $val)
                                                        <div class="form-check me-3 me-lg-5">
                                                            {{
                                                                html()->checkbox('permission[]', in_array($val->id, $rolePermissions) ? true : false, $val->id)
                                                                ->id('editpermission' . $val->id)
                                                                ->class('form-check-input editpermission ' . $sr_pkey)
                                                                ->attributes([
                                                                    'data-val' => $sr_pkey,
                                                                    'data-type' => $val->name
                                                                ])
                                                            }}
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
    {!! html()->closeModelForm() !!}
    <!--/ Edit role form -->
@endif
