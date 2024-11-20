@if (!empty($data))
    {!! html()->modelForm($data)->method('PATCH')->route('currencies.update', Crypt::Encrypt($data->id))->id('editCurrencyForm')->class('restrict-enter')->open() !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_name">Currency Name</label>
                    <input type="text" class="form-control" placeholder="Currency Name" name="currency_name" value="{{ old('currency_name', $data->name) }}" aria-label="Currency Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_code">Currency Code</label>
                    <input type="text" class="form-control" placeholder="Currency Code" name="currency_code" value="{{ old('currency_code', $data->code) }}" aria-label="Currency Code" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_rate">Currency Rate</label>
                    <input type="text" class="form-control" placeholder="Currency Rate" name="currency_rate" value="{{ old('currency_rate', $data->rate) }}" aria-label="Currency Rate" />
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
            <button type="button" class="btn btn-primary" id="editCurrencySubmit">Save changes</button>
        </div>
    {!! html()->closeModelForm() !!}
@endif
