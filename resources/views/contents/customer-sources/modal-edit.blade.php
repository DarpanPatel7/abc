@if (!empty($customer_source))
    {!! Form::model($customer_source, ['method' => 'PATCH','route' => ['customer-sources.update', Crypt::Encrypt($customer_source->id)], 'id'=>'editCustomerSourceForm']) !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editCustomerSourceModalLabel">Edit Customer Source</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col mb-3 inp-group">
                    <label class="form-label" for="customer_source_name">Customer Source Name</label>
                    <input type="text" class="form-control" placeholder="Customer Source Name" name="customer_source_name" value="{{ old('name', $customer_source->name) }}" aria-label="Customer Source Name" />
                </div>
            </div>
            <div class="row">
                <div class="col mb-0">
                    <label class="form-label" for="customer_source_status">Status</label>
                    <div>
                        <label class="switch switch-primary">
                            {{ Form::checkbox('status', 1, ($customer_source->status == 1) ? true : false, array('class' => 'switch-input','id' => 'editstatus')) }}
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
            <button type="button" class="btn btn-primary" id="editCustomerSourceSubmit">Save changes</button>
        </div>
    {!! Form::close() !!}
@endif
