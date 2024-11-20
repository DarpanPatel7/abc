@if (!empty($data))
    {!! html()->modelForm($data)->method('PATCH')->route('languages.update', Crypt::Encrypt($data->id))->id('editLanguageForm')->class('restrict-enter')->open() !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editLanguageModalLabel">Edit Language</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="language_name">Language Name</label>
                    <input type="text" class="form-control" placeholder="Language Name" name="language_name" value="{{ old('language_name', $data->name) }}" aria-label="Language Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="language_shortcode">Language Short Code</label>
                    <input type="text" class="form-control" placeholder="Language Short Code" name="language_shortcode" value="{{ old('language_shortcode', $data->shortcode) }}" aria-label="Language Short Code" />
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
            <button type="button" class="btn btn-primary" id="editLanguageSubmit">Save changes</button>
        </div>
    {!! html()->closeModelForm() !!}
@endif
