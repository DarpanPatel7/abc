@if(Route::is(['customer-sources.index']))
<!-- add customer source -->
<div class="modal fade" id="addCustomerSourceModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(array('route' => 'customer-sources.store','method'=>'POST','id'=>'addCustomerSourceForm','class'=>'restrict-enter')) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerSourceModalLabel">Add Customer Source</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="customer_source_name">Customer Source Name</label>
                            <input type="text" class="form-control" placeholder="Customer Source Name" name="customer_source_name" aria-label="Customer Source Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="customer_source_status">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ Form::checkbox('status', 1, true, array('class' => 'switch-input')) }}
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
                    <button type="button" class="btn btn-primary" id="addCustomerSourceSubmit">Save changes</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- edit customer source -->
<div class="modal fade" id="editCustomerSourceModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="editCustomerSourceContent"></div>
        </div>
    </div>
</div>
@endif
