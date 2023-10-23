@if (!empty($menu))
    {!! Form::model($menu, ['method' => 'PATCH','route' => ['menus.update', Crypt::Encrypt($menu->id)], 'id'=>'editMenuForm']) !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="row">
                    <div class="col mb-3 inp-group">
                        <label class="form-label" for="type">Type</label>
                        <input type="text" class="form-control" placeholder="Type" name="type" aria-label="Type" value="{{ old('name', $menu->type) }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3 inp-group">
                        <label class="form-label">Menu Json</label>
                        <textarea class="form-control" name="json_menu" rows="10">{{ old('name', $menu->json_menu) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ Form::checkbox('status', 1, ($menu->status == 1) ? true : false, array('class' => 'switch-input','id' => 'editstatus')) }}
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
            <button type="button" class="btn btn-primary" id="editMenuSubmit">Save changes</button>
        </div>
    {!! Form::close() !!}
@endif
