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
        var defaultImage = "{{ config('global.default_pfp') }}";
        var defaultImageBase64 = "{{ config('global.default_pfp_base64') }}";
        var getStateByCountry_url = '{{ url('account-settings.getStateByCountry') }}';
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
                            <p class="mb-0">Allowed JPG, JPEG or PNG.</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body dropdownParent">
                    <div class="row">
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Employee No</label>
                            <input type="text" class="form-control" placeholder="Employee No" name="employee_no"
                                aria-label="Employee No" value="{{ old('employee_no', $user->employee_no) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" aria-label="Name"
                                value="{{ old('name', $user->name) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" placeholder="email@example.com" name="email"
                                aria-label="Email" value="{{ old('email', $user->email) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" placeholder="202 555 0111" name="phone_number"
                                aria-label="Phone Number" value="{{ old('phone_number', $user->phone_number) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" name="date_of_birth"
                                placeholder="{{ config('global.datepicker_date_placeholder') }}"
                                class="form-control bs-datepicker" data-autoclose="true"
                                data-format="{{ config('global.datepicker_date_format') }}"
                                value="{{ old('date_of_birth', $user->Dob) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label">Joining Date</label>
                            <input type="text" name="joining_date"
                                placeholder="{{ config('global.datepicker_date_placeholder') }}"
                                class="form-control bs-datepicker" data-autoclose="true"
                                data-format="{{ config('global.datepicker_date_format') }}"
                                value="{{ old('joining_date', $user->Jd) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label class="form-label" for="country">Country</label>
                            {!! Form::select('country', $countries, $user->country_id ?? [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'country',
                                'placeholder' => 'Select Country',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="state" class="form-label">State</label>
                            <div id="stateContent">
                                {!! Form::select('state', $statesbycountry, $user->state_id ?? [], [
                                    'class' => 'select2 form-select form-select-lg',
                                    'id' => 'state',
                                    'placeholder' => 'Select State',
                                    'data-allow-clear' => 'true',
                                ]) !!}
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="address"
                                aria-label="Address" value="{{ old('address', $user->address) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="zipcode" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" placeholder="231465" name="zipcode"
                                maxlength="6" aria-label="Zip Code" value="{{ old('zipcode', $user->zipcode) }}" />
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="language" class="form-label">Language</label>
                            {!! Form::select('language', $languages, $user->langauge_id ?? [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'language',
                                'placeholder' => 'Select Language',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="timezone" class="form-label">Timezone</label>
                            {!! Form::select('timezone', $timezones, $user->timezone_id ?? [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'timezone',
                                'placeholder' => 'Select Timezone',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="currency" class="form-label">Currency</label>
                            {!! Form::select('currency', $currencies, $user->currency_id ?? [], [
                                'class' => 'select2 form-select form-select-lg',
                                'id' => 'currency',
                                'placeholder' => 'Select Currency',
                                'data-allow-clear' => 'true',
                            ]) !!}
                        </div>
                        <div class="mb-3 col-md-6 inp-group">
                            <label for="designation" class="form-label">Designation</label>
                            {!! Form::select('designation', $designations, $user->designation_id ?? [], [
                                'class' => 'select2 form-select form-select-lg',
                                'placeholder' => 'Select Designation',
                                'data-allow-clear' => 'true',
                                'id' => 'designation',
                            ]) !!}
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3 inp-group">
                            <label for="organization" class="form-label">Organization</label>
                            <input type="text" class="form-control" placeholder="Organization" name="organization"
                                aria-label="Organization" value="{{ old('organization', $user->organization) }}" />
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-3 inp-group">
                                <label class="form-label">Identity Proof</label>
                                <input class="form-control" type="file" name="identity_proof"
                                    accept="application/pdf,image/*">
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3 inp-group">
                                <label class="form-label"></label>
                                @if (!empty($user->IdentityProofPath))
                                    <a href="{{ $user->IdentityProofPath }}"
                                        class="btn btn-label-secondary btn-icon mt-4" target="_blank"><i
                                            class="bx bx-show"></i></a>
                                @endif
                            </div>
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
                    {!! Form::open([
                        'route' => 'account-settings.deactivateAccount',
                        'method' => 'POST',
                        'id' => 'deactivateAccountForm',
                        'class' => 'restrict-enter',
                    ]) !!}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accountDeactivation"
                                id="accountDeactivation" />
                            <label class="form-check-label" for="accountDeactivation">I confirm my account
                                deactivation</label>
                        </div>
                        <button type="button" class="btn btn-danger" id="deactivateAccount">Deactivate Account</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.account-settings.modal')
    @endcomponent
@endsection
