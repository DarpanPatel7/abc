@if(Route::is(['admin-menus.index']))
<!-- add admin menu -->
<div class="modal fade" id="addAdminMenuModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content dropdownParent">
            {!! html()->form('POST')->route('admin-menus.store')->id('addAdminMenuForm')->class('restrict-enter')->open() !!}
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
                            {{
                                html()->select('menu_type', $menu_types, [])
                                ->id('addMenuType')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Menu Type')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
                        </div>
                    </div>
                    <div class="row" id="blkParentMenu">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="addParentMenu">Parent Menu</label>
                            <div id="addParentMenuContent">
                                {{
                                    html()->select('parent_menu', [], [])
                                    ->id('addParentMenu')
                                    ->class('select2 form-select form-select-lg')
                                    ->placeholder('Select Parent Menu')
                                    ->attributes([
                                        'data-allow-clear' => 'true'  // Add more attributes here as needed
                                    ])
                                }}
                            </div>
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
                    <button type="button" class="btn btn-primary" id="addAdminMenuSubmit">Save changes</button>
                </div>
            {!! html()->form()->close() !!}
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
