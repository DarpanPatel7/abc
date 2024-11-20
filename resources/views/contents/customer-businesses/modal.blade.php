@if(Route::is(['customer-businesses.index']))
<!-- add customer business -->
<div class="modal fade" id="addCustomerBusinessModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! html()->form('POST')->route('customer-businesses.store')->id('addCustomerBusinessForm')->class('restrict-enter')->open() !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerBusinessModalLabel">Add Customer Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="customer_business_name">Customer Business Name</label>
                            <input type="text" class="form-control" placeholder="Customer Business Name" name="customer_business_name" aria-label="Customer Business Name" />
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
                    <button type="button" class="btn btn-primary" id="addCustomerBusinessSubmit">Save changes</button>
                </div>
            {!! html()->form()->close() !!}
        </div>
    </div>
</div>

<!-- edit customer business -->
<div class="modal fade" id="editCustomerBusinessModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="editCustomerBusinessContent"></div>
        </div>
    </div>
</div>
@endif
