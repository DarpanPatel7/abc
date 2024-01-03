@if (!empty($data))
    {!! Form::model($data, ['method' => 'PATCH','route' => ['timezones.update', Crypt::Encrypt($data->id)], 'id'=>'editTimezoneForm']) !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editTimezoneModalLabel">Edit Timezone</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="timezone_name">Timezone Name</label>
                    <input type="text" class="form-control" placeholder="Timezone Name" name="timezone_name" value="{{ old('timezone_name', $data->name) }}" aria-label="Timezone Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="timezone_utc_offset">Timezone UTC Offset</label>
                    <input type="text" class="form-control" placeholder="Timezone UTC Offset" name="timezone_utc_offset" value="{{ old('timezone_utc_offset', $data->utc_offset) }}" aria-label="Timezone UTC Offset" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label" for="editstatus">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ Form::checkbox('status', 1, ($data->status == 1) ? true : false, array('class' => 'switch-input', 'id' => 'editstatus')) }}
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
            <button type="button" class="btn btn-primary" id="editTimezoneSubmit">Save changes</button>
        </div>
    {!! Form::close() !!}
@endif
