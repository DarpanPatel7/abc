@if (Route::is(['employees.index']))
    <!-- add employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content dropdownParent">
                {!! Form::open([
                    'route' => 'employees.store',
                    'method' => 'POST',
                    'id' => 'addEmployeeForm',
                    'class' => 'restrict-enter drop-parent',
                ]) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="profile-img-wrap col-lg-3 col-md-2 text-center">
                            <div class="profile-img profile-avatar-xxl">
                                <a href="javascript:;" id="profile_img"><img alt="Profile Picture"
                                        src="{{ config('global.default_pfp') }}"
                                        class="avatar-img rounded-circle preview-profile-image" height="100"></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group mt-3">
                            <button type="button" class="btn btn-sm btn-label-primary mb-3" id="select_image">
                                Select Profile Photo
                            </button>
                            </br>
                            <button type="button" class="btn btn-sm btn-label-primary" id="clear_image">
                                Clear
                            </button>
                            <input type="hidden" name="profile_photo" class="profile_photo">
                            <input type="file" id="h_file" class="item-img file center-block"
                                accept="image/png, image/jpg, image/jpeg, image/svg" style="display: none;" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Employee No</label>
                            <input type="text" class="form-control" placeholder="Employee No" name="employee_no"
                                aria-label="Employee No" />
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control" placeholder="email@example.com" name="email"
                                aria-label="Email" />
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="202 555 0111" name="phone_number"
                                aria-label="Phone Number" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" class="form-control bs-datepicker"
                                placeholder="{{ config('global.datepicker_date_placeholder') }}" name="date_of_birth"
                                data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" />
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Joining Date</label>
                            <input type="text" class="form-control bs-datepicker"
                                placeholder="{{ config('global.datepicker_date_placeholder') }}" name="joining_date"
                                data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label" for="addCountry">Country</label>
                            {!! Form::select(
                                'country',
                                $countries,
                                [],
                                [
                                    'class' => 'select2 form-select form-select-lg',
                                    'id' => 'addCountry',
                                    'placeholder' => 'Select Country',
                                    'data-allow-clear' => 'true',
                                ],
                            ) !!}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label" for="addState">State</label>
                            <div id="addStateContent">
                                {!! Form::select(
                                    'state',
                                    [],
                                    [],
                                    [
                                        'class' => 'select2 form-select form-select-lg',
                                        'id' => 'addState',
                                        'placeholder' => 'Select State',
                                        'data-allow-clear' => 'true',
                                    ],
                                ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="address"
                                aria-label="Address" />
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" placeholder="231465" name="zipcode"
                                maxlength="6" aria-label="Zip Code" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addLanguage" class="form-label">Language</label>
                            {!! Form::select('language', $languages, [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'addLanguage',
                                'placeholder' => 'Select Language',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addTimezone" class="form-label">Timezone</label>
                            {!! Form::select('timezone', $timezones, [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'addTimezone',
                                'placeholder' => 'Select Timezone',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addCurrency" class="form-label">Currency</label>
                            {!! Form::select(
                                'currency',
                                $currencies,
                                [],
                                [
                                    'class' => 'select2 form-select form-select-lg',
                                    'id' => 'addCurrency',
                                    'placeholder' => 'Select Currency',
                                    'data-allow-clear' => 'true',
                                ],
                            ) !!}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addDesignation" class="form-label">Designation</label>
                            {!! Form::select(
                                'designation',
                                $designations,
                                [],
                                [
                                    'class' => 'select2 form-select form-select-lg',
                                    'placeholder' => 'Select Designation',
                                    'data-allow-clear' => 'true',
                                    'id' => 'addDesignation',
                                ],
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Organization</label>
                            <input type="text" class="form-control" placeholder="Organization" name="organization"
                                aria-label="Organization" />
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label">Identity Proof</label>
                            <input type="file" class="form-control" name="identity_proof"
                                accept="application/pdf,image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-0">
                            <label class="form-label" for="addStatus">Status</label>
                            <div>
                                <label class="switch switch-primary">
                                    {{ Form::checkbox('status', 1, true, ['class' => 'switch-input', 'id' => 'addStatus']) }}
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
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content dropdownParent">
                <div id="editEmployeeContent"></div>
            </div>
        </div>
    </div>
    <!-- edit employee -->

    <!-- profile photo -->
    <div class="modal fade" id="cropImagePop" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div id="upload-demo" class="center-block"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="cropImageBtn">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <!-- profile photo -->
@endif
