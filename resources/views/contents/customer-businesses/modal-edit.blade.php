@if (!empty($data))
    {!! html()->modelForm($data)->method('PATCH')->route('customer-businesses.update', Crypt::Encrypt($data->id))->id('editCustomerBusinessForm')->class('restrict-enter')->open() !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editCustomerBusinessModalLabel">Edit Customer Business</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="customer_business_name">Customer Business Name</label>
                    <input type="text" class="form-control" placeholder="Customer Business Name" name="customer_business_name" value="{{ old('customer_business_name', $data->name) }}" aria-label="Customer Business Name" />
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
            <button type="button" class="btn btn-primary" id="editCustomerBusinessSubmit">Save changes</button>
        </div>
    {!! html()->closeModelForm() !!}
@endif
