@if (!empty($currency))
    {!! Form::model($currency, ['method' => 'PATCH','route' => ['currencies.update', Crypt::Encrypt($currency->id)], 'id'=>'editCurrencyForm']) !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editCurrencyModalLabel">Edit Currency</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_name">Currency Name</label>
                    <input type="text" class="form-control" placeholder="Currency Name" name="currency_name" value="{{ old('currency_name', $currency->name) }}" aria-label="Currency Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_code">Currency Code</label>
                    <input type="text" class="form-control" placeholder="Currency Code" name="currency_code" value="{{ old('currency_code', $currency->code) }}" aria-label="Currency Code" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="currency_rate">Currency Rate</label>
                    <input type="text" class="form-control" placeholder="Currency Rate" name="currency_rate" value="{{ old('currency_rate', $currency->rate) }}" aria-label="Currency Rate" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label" for="editstatus">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ Form::checkbox('status', 1, ($currency->status == 1) ? true : false, array('class' => 'switch-input', 'id' => 'editstatus')) }}
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
    {!! Form::close() !!}
@endif
