@if (!empty($data))
    {!! html()->modelForm($data)->method('PATCH')->route('employees.update', Crypt::Encrypt($data->id))->id('editEmployeeForm')->class('restrict-enter')->open() !!}
        <div class="modal-header">
            <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-3">
                <div class="profile-img-wrap col-lg-3 col-md-2 text-center">
                    <div class="profile-img profile-avatar-xxl">
                        <a href="javascript:;" id="profile_img"><img alt="Profile Picture" src="{{ $data->ProfilePhotoPath ?? '' }}" class="avatar-img rounded-circle preview-profile-image" height="100"></a>
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
                    <input type="text" class="form-control" placeholder="Employee No" name="employee_no" aria-label="Employee No" value="{{ old('employee_no', $data->employee_no) }}" />
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name" value="{{ old('name', $data->name) }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" class="form-control" placeholder="email@example.com" name="email"
                        aria-label="Email" value="{{ old('email', $data->email) }}" />
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label" for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" placeholder="202 555 0111" name="phone_number"
                        aria-label="Phone Number" value="{{ old('phone_number', $data->phone_number) }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="text" name="date_of_birth" placeholder="{{ config('global.datepicker_date_placeholder') }}" class="form-control bs-datepicker" data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" value="{{ old('date_of_birth', $data->Dob) }}"/>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Joining Date</label>
                    <input type="text" name="joining_date" placeholder="{{ config('global.datepicker_date_placeholder') }}" class="form-control bs-datepicker" data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" value="{{ old('joining_date', $data->Jd) }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label" for="editCountry">Country</label>
                    {{
                        html()->select('country', $countries, $data->country_id ?? [])
                        ->id('editCountry')
                        ->class('select2 form-select form-select-lg')
                        ->placeholder('Select Country')
                        ->attributes([
                            'data-allow-clear' => 'true'  // Add more attributes here as needed
                        ])
                    }}
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="editState" class="form-label">State</label>
                    <div id="editStateContent">
                        {{
                            html()->select('state', $statesbycountry, $data->state_id ?? [])
                            ->id('editState')
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
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address"
                        aria-label="Address" value="{{ old('address', $data->address) }}" />
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="zipcode" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" placeholder="231465" name="zipcode"
                        maxlength="6" aria-label="Zip Code" value="{{ old('zipcode', $data->zipcode) }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="editLanguage" class="form-label">Language</label>
                    {{
                        html()->select('language', $languages, $data->langauge_id ?? [])
                        ->id('editLanguage')
                        ->class('select2 form-select form-select-lg')
                        ->placeholder('Select Language')
                        ->attributes([
                            'data-allow-clear' => 'true'  // Add more attributes here as needed
                        ])
                    }}
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="editTimezone" class="form-label">Timezone</label>
                    {{
                        html()->select('timezone', $timezones, $data->timezone_id ?? [])
                        ->id('editTimezone')
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
                    <label for="editCurrency" class="form-label">Currency</label>
                    {{
                        html()->select('currency', $currencies, $data->currency_id ?? [])
                        ->id('editCurrency')
                        ->class('select2 form-select form-select-lg')
                        ->placeholder('Select Currency')
                        ->attributes([
                            'data-allow-clear' => 'true'  // Add more attributes here as needed
                        ])
                    }}
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label for="editDesignation" class="form-label">Designation</label>
                    {{
                        html()->select('designation', $designations, $data->designation_id ?? [])
                        ->id('editDesignation')
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
                    <label for="organization" class="form-label">Organization</label>
                    <input type="text" class="form-control" placeholder="Organization" name="organization"
                        aria-label="Organization" value="{{ old('organization', $data->organization) }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Identity Proof</label>
                    <input class="form-control" type="file" name="identity_proof" accept="application/pdf,image/*">
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label"></label>
                    @if (!empty($data->IdentityProofPath))
                        <a href="{{ $data->IdentityProofPath }}" class="btn btn-label-secondary btn-icon mt-4" target="_blank"><i class="bx bx-show"></i></a>
                    @endif
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
            <button type="button" class="btn btn-primary" id="editEmployeeSubmit">Save changes</button>
        </div>
    {!! html()->closeModelForm() !!}
@endif
