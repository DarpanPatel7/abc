@if (Route::is(['currencies.index']))
    <!-- add currency -->
    <div class="modal fade" id="addCurrencyModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! html()->form('POST')->route('currencies.store')->id('addCurrencyForm')->class('restrict-enter')->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addCurrencyModalLabel">Add Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="currency_name">Currency Name</label>
                            <input type="text" class="form-control" placeholder="Currency Name" name="currency_name"
                                aria-label="Currency Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="currency_code">Currency Code</label>
                            <input type="text" class="form-control" placeholder="Currency Code" name="currency_code"
                                aria-label="Currency Code" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="currency_rate">Currency Rate</label>
                            <input type="text" class="form-control" placeholder="Currency Rate" name="currency_rate"
                                aria-label="Currency Rate" />
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
                    <button type="button" class="btn btn-primary" id="addCurrencySubmit">Save changes</button>
                </div>
                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>

    <!-- edit currency -->
    <div class="modal fade" id="editCurrencyModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="editCurrencyContent"></div>
            </div>
        </div>
    </div>
@endif
