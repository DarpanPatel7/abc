@if (Route::is(['employees.index']))
    <!-- add employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content dropdownParent">
                {!! html()->form('POST')->route('employees.store')->id('addEmployeeForm')->class('restrict-enter drop-parent')->open() !!}
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
                            {{
                                html()->select('country', $countries, [])
                                ->id('addCountry')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Country')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label class="form-label" for="addState">State</label>
                            <div id="addStateContent">
                                {{
                                    html()->select('state', [], [])
                                    ->id('addState')
                                    ->class('select2 form-select form-select-lg')
                                    ->placeholder('Select State')
                                    ->attributes([
                                        'data-allow-clear' => 'true'  // Add more attributes here as needed
                                    ])
                                }}
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
                            {{
                                html()->select('language', $languages, [])
                                ->id('addLanguage')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Language')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addTimezone" class="form-label">Timezone</label>
                            {{
                                html()->select('timezone', $timezones, [])
                                ->id('addTimezone')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Timezone')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addCurrency" class="form-label">Currency</label>
                            {{
                                html()->select('currency', $currencies, [])
                                ->id('addCurrency')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Currency')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="addDesignation" class="form-label">Designation</label>
                            {{
                                html()->select('designation', $designations, [])
                                ->id('addDesignation')
                                ->class('select2 form-select form-select-lg')
                                ->placeholder('Select Designation')
                                ->attributes([
                                    'data-allow-clear' => 'true'  // Add more attributes here as needed
                                ])
                            }}
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
                                    {{ html()->checkbox('status', true, 1)->id('addStatus')->class('switch-input') }}
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
                {!! html()->form()->close() !!}
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
