@if (Route::is(['roles.index']))
    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <!-- Add role form -->
            {!! Form::open([
                'route' => 'roles.store',
                'method' => 'POST',
                'id' => 'addRoleForm',
                'class' => 'restrict-enter row g-3 fv-plugins-bootstrap5 fv-plugins-framework w-100',
            ]) !!}
                <div class="modal-content p-3 p-md-5 mt-0">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h3 class="role-title">Add New Role</h3>
                            <p>Set role permissions</p>
                        </div>
                        <div class="col-12 mb-4 fv-plugins-icon-container inp-group">
                            <label class="form-label" for="role_name">Role Name</label>
                            <input type="text" id="role_name" name="role_name" class="form-control"
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
                                                    <td>
                                                        <div class="d-flex flex-wrap">
                                                            <div class="form-check me-3 me-lg-5">
                                                                {{ Form::checkbox('module_all_permissions', null, false, ['class' => 'form-check-input addmodule_all_permissions', 'data-key' => $sr_pkey, 'id' => 'addmodule_all_permissions' . $sr_pkey]) }}
                                                                <label class="form-check-label"
                                                                    for="addmodule_all_permissions{{ $sr_pkey }}">
                                                                    {{ $pkey }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-wrap">
                                                            @foreach ($pval as $key => $val)
                                                                <div class="form-check me-3 me-lg-5">
                                                                    {{ Form::checkbox('permission[]', $val->id, false, ['class' => 'form-check-input addpermission ' . $sr_pkey, 'data-val' => $sr_pkey, 'data-type' => $val->name, 'id' => 'addpermission' . $val->id]) }}
                                                                    <label class="form-check-label"
                                                                        for="addpermission{{ $val->id }}">
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
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1" id="addRoleSubmit">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!--/ Add role form -->
        </div>
    </div>
    <!--/ Add Role Modal -->

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-new-role">
            <div id="editRoleContent" style="display: contents;"></div>
        </div>
    </div>
    <!--/ Edit Role Modal -->

    <!-- Assign Role Modal -->
    <div class="modal fade" id="assignRoleModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-assign-new-role">
            <div id="assignRoleContent" style="display: contents;"></div>
        </div>
    </div>
    <!--/ Assign Role Modal -->
@endif
