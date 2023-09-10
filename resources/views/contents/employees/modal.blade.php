@if(Route::is(['employees.index']))
<!-- add employee -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Designation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('route' => 'employees.store','method'=>'POST','id'=>'addEmployeeForm','class'=>'restrict-enter')) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="employee_no">Employee No</label>
                            <input type="text" class="form-control" placeholder="Employee No" name="employee_no" aria-label="Employee No" />
                        </div>
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="current_address">Current Address</label>
                            <textarea class="form-control" id="current_address" rows="3"></textarea>
                        </div>
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="permanent_address">Permanent Address</label>
                            <textarea class="form-control" id="permanent_address" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="date_of_birth">Date of Birth</label>
                            <input type="date_of_birth" id="dob" class="form-control" placeholder="Date of Birth" name="date_of_birth" aria-label="Date of Birth">
                        </div>
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="name">Joining Date</label>
                            <input type="date" id="dobLarge" class="form-control" placeholder="Employee No" name="employee_no" aria-label="Employee No">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="formValidationSelect2">Country</label>
                            <select id="formValidationSelect2" name="formValidationSelect2" class="form-select select2" data-allow-clear="true">
                            <option value="">Select</option>
                            <option value="Australia">Australia</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Canada">Canada</option>
                            <option value="China">China</option>
                            <option value="France">France</option>
                            <option value="Germany">Germany</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Japan">Japan</option>
                            <option value="Korea">Korea, Republic of</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Russia">Russian Federation</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="designation_status">Status</label>
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
                    <button type="button" class="btn btn-primary" id="addEmployeeSubmit">Save changes</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- edit employee -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="editEmployeeContent"></div>
        </div>
    </div>
</div>
@endif