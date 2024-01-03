@if (Route::is(['timezones.index']))
    <!-- add Timezone -->
    <div class="modal fade" id="addTimezoneModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open([
                    'route' => 'timezones.store',
                    'method' => 'POST',
                    'id' => 'addTimezoneForm',
                    'class' => 'restrict-enter',
                ]) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addTimezoneModalLabel">Add Timezone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="timezone_name">Timezone Name</label>
                            <input type="text" class="form-control" placeholder="Timezone Name" name="timezone_name"
                                aria-label="Timezone Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="timezone_utc_offset">Timezone Utc Offset</label>
                            <input type="text" class="form-control" placeholder="Timezone Utc Offset" name="timezone_utc_offset"
                                aria-label="Timezone Utc Offset" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="addstatus">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ Form::checkbox('status', 1, true, ['class' => 'switch-input', 'id' => 'addstatus']) }}
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
                    <button type="button" class="btn btn-primary" id="addTimezoneSubmit">Save changes</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- edit Timezone -->
    <div class="modal fade" id="editTimezoneModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="editTimezoneContent"></div>
            </div>
        </div>
    </div>
@endif
