@if(Route::is(['admin-menus.index']))
<!-- add admin menu -->
<div class="modal fade" id="addAdminMenuModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content dropdownParent">
            {!! Form::open(array('route' => 'admin-menus.store','method'=>'POST','id'=>'addAdminMenuForm','class'=>'restrict-enter')) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminMenuModalLabel">Add Admin Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="menu_name">Menu Name</label>
                            <input type="text" class="form-control" placeholder="Menu Name" name="menu_name" aria-label="Menu Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="menu_url">Menu Url</label>
                            <input type="text" class="form-control" placeholder="Menu Url" name="menu_url" aria-label="Menu Url" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="addMenuType">Menu Type</label>
                            {!! Form::select(
                                'menu_type',
                                $menu_types,
                                [],
                                [
                                    'class' => 'select2 form-select form-select-lg',
                                    'id' => 'addMenuType',
                                    'placeholder' => 'Select Menu Type',
                                    'data-allow-clear' => 'true',
                                ],
                            ) !!}
                        </div>
                    </div>
                    <div class="row" id="blkParentMenu">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="addParentMenu">Parent Menu</label>
                            <div id="addParentMenuContent">
                                {!! Form::select(
                                    'parent_menu',
                                    [],
                                    [],
                                    [
                                        'class' => 'select2 form-select form-select-lg',
                                        'id' => 'addParentMenu',
                                        'placeholder' => 'Select Parent Menu',
                                        'data-allow-clear' => 'true',
                                    ],
                                ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="addstatus">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ Form::checkbox('status', 1, true, array('class' => 'switch-input', 'id' => 'addstatus')) }}
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
                    <button type="button" class="btn btn-primary" id="addAdminMenuSubmit">Save changes</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- edit admin menu -->
<div class="modal fade" id="editAdminMenuModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content dropdownParent">
            <div id="editAdminMenuContent"></div>
        </div>
    </div>
</div>
@endif
