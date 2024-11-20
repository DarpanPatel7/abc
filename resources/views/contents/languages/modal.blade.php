@if (Route::is(['languages.index']))
    <!-- add Language -->
    <div class="modal fade" id="addLanguageModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! html()->form('POST')->route('languages.store')->id('addLanguageForm')->class('restrict-enter')->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addLanguageModalLabel">Add Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="language_name">Language Name</label>
                            <input type="text" class="form-control" placeholder="Language Name" name="language_name"
                                aria-label="Language Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="language_shortcode">Language Short Code</label>
                            <input type="text" class="form-control" placeholder="Language Short Code" name="language_shortcode"
                                aria-label="Language Short Code" />
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
                    <button type="button" class="btn btn-primary" id="addLanguageSubmit">Save changes</button>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>

    <!-- edit Language -->
    <div class="modal fade" id="editLanguageModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="editLanguageContent"></div>
            </div>
        </div>
    </div>
@endif
