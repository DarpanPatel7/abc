@extends('layouts/layoutMaster')

@section('title', 'Account settings - Account')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <style>
        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script type="text/javascript">
        var defaultImage = "{{ url('assets/img/default-pfp.png') }}";
        var getStateByCountry_url = '{{ url("account-settings.getStateByCountry") }}';
    </script>
    <script src="{{ asset('assets/js/modules/account-settings-account.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item"><a class="nav-link active" href="{{ route('account-settings.account') }}"><i
                            class="bx bx-user me-1"></i> Account</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('account-settings.security') }}"><i
                            class="bx bx-lock-alt me-1"></i> Security</a></li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                {!! Form::open([
                    'route' => 'account-settings.saveAccount',
                    'method' => 'POST',
                    'id' => 'saveAccountForm',
                    'class' => 'restrict-enter',
                ]) !!}
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="profile-img profile-avatar-xxl">
                            <a href="javascript:;" id="profile_img"><img alt="Profile Picture"
                                    src="{{ $user->ProfilePhotoPath ?? '' }}"
                                    class="avatar-img rounded-circle preview-profile-image" height="100"></a>
                        </div>
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0" id="select_image">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="hidden" name="profile_photo" class="profile_photo">
                            </label>
                            <input type="file" id="h_file" class="item-img file center-block"
                                accept="image/png, image/jpg, image/jpeg, image/svg" style="display: none;" />
                            <button type="button" class="btn btn-label-secondary account-image-reset mb-4"
                                id="clear_image">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>
                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Employee No</label>
                            <input type="text" class="form-control" placeholder="Employee No" name="employee_no" aria-label="Employee No" value="{{ old('employee_no', $user->employee_no) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name" value="{{ old('name', $user->name) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email"
                                value="{{ old('email', $user->email) }}" placeholder="email@example.com" disabled/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" class="form-control" id="organization" name="organization"
                                value="{{ old('organization', $user->organization) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" name="date_of_birth" placeholder="{{ config('global.datepicker_date_placeholder') }}" class="form-control bs-datepicker" data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" value="{{ old('date_of_birth', $user->Dob) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Joining Date</label>
                            <input type="text" name="joining_date" placeholder="{{ config('global.datepicker_date_placeholder') }}" class="form-control bs-datepicker" data-autoclose="true" data-format="{{ config('global.datepicker_date_format') }}" value="{{ old('joining_date', $user->Jd) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">US (+1)</span>
                                <input type="text" id="phone_number" name="phone_number" class="form-control"
                                    placeholder="202 555 0111" value="{{ old('phone_number', $user->phone_number) }}"/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label" for="country">Country</label>
                            {!! Form::select(
                                'country',
                                $countries,
                                $user->country_id ?? [],
                                [
                                    'class' => 'select2 form-select form-select-lg',
                                    'id' => 'country',
                                    'placeholder' => 'Select Country',
                                    'data-allow-clear' => 'true',
                                ],
                            ) !!}
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="state" class="form-label">State</label>
                            <div id="state_content">
                                {!! Form::select(
                                    'state',
                                    [],
                                    $user->state_id ?? [],
                                    [
                                        'class' => 'select2 form-select form-select-lg',
                                        'id' => 'state',
                                        'placeholder' => 'Select State',
                                        'data-allow-clear' => 'true',
                                    ],
                                ) !!}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Address" value="{{ old('address', $user->address) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="zipcode" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode"
                                placeholder="231465" maxlength="6" value="{{ old('zipcode', $user->address) }}"/>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="language" class="form-label">Language</label>
                            <select id="language" class="select2 form-select">
                                <option value="">Select Language</option>
                                <option value="en">English</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="pt">Portuguese</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="timeZones" class="form-label">Timezone</label>
                            <select id="timeZones" class="select2 form-select">
                                <option value="">Select Timezone</option>
                                <option value="-12">(GMT-12:00) International Date Line West</option>
                                <option value="-11">(GMT-11:00) Midway Island, Samoa</option>
                                <option value="-10">(GMT-10:00) Hawaii</option>
                                <option value="-9">(GMT-09:00) Alaska</option>
                                <option value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
                                <option value="-8">(GMT-08:00) Tijuana, Baja California</option>
                                <option value="-7">(GMT-07:00) Arizona</option>
                                <option value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                <option value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
                                <option value="-6">(GMT-06:00) Central America</option>
                                <option value="-6">(GMT-06:00) Central Time (US & Canada)</option>
                                <option value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                <option value="-6">(GMT-06:00) Saskatchewan</option>
                                <option value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                <option value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option value="-5">(GMT-05:00) Indiana (East)</option>
                                <option value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
                                <option value="-4">(GMT-04:00) Caracas, La Paz</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="currency" class="form-label">Currency</label>
                            <select id="currency" class="select2 form-select">
                                <option value="">Select Currency</option>
                                <option value="usd">USD</option>
                                <option value="euro">Euro</option>
                                <option value="pound">Pound</option>
                                <option value="bitcoin">Bitcoin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-primary me-2" id="saveAccount">Save changes</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                    </div>
                    <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accountActivation"
                                id="accountActivation" />
                            <label class="form-check-label" for="accountActivation">I confirm my account
                                deactivation</label>
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.account-settings.modal')
    @endcomponent
@endsection
