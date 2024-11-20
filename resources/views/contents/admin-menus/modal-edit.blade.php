@if (!empty($data))
    {!! html()->modelForm($data)->method('PATCH')->route('admin-menus.update', Crypt::Encrypt($data->id))->id('editAdminMenuForm')->class('restrict-enter')->open() !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editAdminMenuModalLabel">Edit Admin Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="menu_name">Menu Name</label>
                    <input type="text" class="form-control" placeholder="Menu Name" name="menu_name" value="{{ old('menu_name', $data->menu_name) }}" aria-label="Menu Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="menu_url">Menu Url</label>
                    <input type="text" class="form-control" placeholder="Menu Url" name="menu_url" value="{{ old('menu_url', $data->menu_url) }}" aria-label="Menu Url" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="editMenuType">Menu Type</label>
                    {{
                        html()->select('menu_type', $menu_types, $data->menu_type ?? [])
                        ->id('editMenuType')
                        ->class('select2 form-select form-select-lg')
                        ->placeholder('Select Menu Type')
                        ->attributes([
                            'data-allow-clear' => 'true'  // Add more attributes here as needed
                        ])
                    }}
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label" for="editstatus">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ html()->checkbox('status', ($data->status == 1) ? true : false, 1)->id('editstatus')->class('switch-input') }}
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
            <button type="button" class="btn btn-primary" id="editAdminMenuSubmit">Save changes</button>
        </div>
    {!! html()->closeModelForm() !!}
@endif
