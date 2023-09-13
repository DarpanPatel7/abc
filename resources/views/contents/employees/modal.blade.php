@if (Route::is(['employees.index']))
    <!-- add employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open([
                    'route' => 'employees.store',
                    'method' => 'POST',
                    'id' => 'addEmployeeForm',
                    'class' => 'restrict-enter',
                ]) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="employee_no">Employee No</label>
                            <input type="text" class="form-control" placeholder="Employee No" name="employee_no"
                                aria-label="Employee No" />
                        </div>
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Name" />
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
                            <input type="date_of_birth" id="dob" class="form-control" placeholder="Date of Birth"
                                name="date_of_birth" aria-label="Date of Birth">
                        </div>
                        <div class="col mb-3 inp-group">
                            <label class="form-label" for="name">Joining Date</label>
                            <input type="date" id="dobLarge" class="form-control" placeholder="Employee No"
                                name="employee_no" aria-label="Employee No">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label for="profile_photo" class="form-label">Profile Pic</label>
                            <input class="form-control" type="file" name="profile_photo">
                        </div>
                        <div class="col mb-3 inp-group">
                            <label for="identiy_proof" class="form-label">Identiy Proof</label>
                            <input class="form-control" type="file" name="identiy_proof">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3 inp-group">
                            <label for="select2Basic" class="form-label">Basic</label>
                            <select id="select2Basic" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
                                <option value="AK">Alaska</option>
                                <option value="HI">Hawaii</option>
                                <option value="CA">California</option>
                                <option value="NV">Nevada</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                                <option value="AZ">Arizona</option>
                                <option value="CO">Colorado</option>
                                <option value="ID">Idaho</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NM">New Mexico</option>
                                <option value="ND">North Dakota</option>
                                <option value="UT">Utah</option>
                                <option value="WY">Wyoming</option>
                                <option value="AL">Alabama</option>
                                <option value="AR">Arkansas</option>
                                <option value="IL">Illinois</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="OK">Oklahoma</option>
                                <option value="SD">South Dakota</option>
                                <option value="TX">Texas</option>
                                <option value="TN">Tennessee</option>
                                <option value="WI">Wisconsin</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="IN">Indiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="OH">Ohio</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WV">West Virginia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="designation_status">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ Form::checkbox('status', 1, true, ['class' => 'switch-input']) }}
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
