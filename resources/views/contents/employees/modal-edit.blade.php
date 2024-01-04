@if (!empty($data))
    {!! Form::model($data, ['method' => 'PATCH','route' => ['employees.update', Crypt::Encrypt($data->id)], 'id'=>'editEmployeeForm', 'class' => 'restrict-enter']) !!}
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
                    <input type="text" class="form-control" placeholder="Employee No" name="employee_no" aria-label="Employee No" value="{{ old('employee_no', $data->employee_no) }}"/>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name" value="{{ old('name', $data->name) }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Current Address</label>
                    <textarea class="form-control" name="current_address" rows="3">{{ old('name', $data->current_address) }}</textarea>
                </div>
                <div class="col-md-6 col-sm-12 mb-3 inp-group">
                    <label class="form-label">Permanent Address</label>
                    <textarea class="form-control" name="permanent_address" rows="3">{{ old('name', $data->permanent_address) }}</textarea>
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
                    <label class="form-label">Designation</label>
                    {!! Form::select(
                        'designation',
                        $designations,
                        $data->designation_id ?? [],
                        [
                            'class' => 'select2 form-select form-select-lg',
                            'placeholder' => 'Select Designation',
                            'data-allow-clear' => 'true',
                        ],
                    ) !!}
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
                            {{ Form::checkbox('status', 1, ($data->status == 1) ? true : false, array('class' => 'switch-input','id' => 'editstatus')) }}
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
    {!! Form::close() !!}
@endif
