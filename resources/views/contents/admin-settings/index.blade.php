@extends('layouts/layoutMaster')

@section('title', 'Customer Business List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/modules/customer-business.js') }}"></script>
    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Customer Business List</h4>

    <!-- Form with Tabs -->
    <div class="row">
        <div class="col">
            <h6 class="mt-4"> Form with Tabs </h6>
            <div class="card mb-3">
                <div class="card-header border-bottom">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-personal"
                                role="tab" aria-selected="true">Personal Info</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-account"
                                role="tab" aria-selected="false">Account Details</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-social" role="tab"
                                aria-selected="false">Social Links</button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-first-name">First Name</label>
                                    <input type="text" id="formtabs-first-name" class="form-control"
                                        placeholder="John" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-last-name">Last Name</label>
                                    <input type="text" id="formtabs-last-name" class="form-control" placeholder="Doe" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-country">Country</label>
                                    <select id="formtabs-country" class="select2 form-select" data-allow-clear="true">
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
                                <div class="col-md-6 select2-primary">
                                    <label class="form-label" for="formtabs-language">Language</label>
                                    <select id="formtabs-language" class="select2 form-select" multiple>
                                        <option value="en" selected>English</option>
                                        <option value="fr" selected>French</option>
                                        <option value="de">German</option>
                                        <option value="pt">Portuguese</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-birthdate">Birth Date</label>
                                    <input type="text" id="formtabs-birthdate" class="form-control dob-picker"
                                        placeholder="YYYY-MM-DD" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-phone">Phone No</label>
                                    <input type="text" id="formtabs-phone" class="form-control phone-mask"
                                        placeholder="658 799 8941" aria-label="658 799 8941" />
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-username">Username</label>
                                    <input type="text" id="formtabs-username" class="form-control"
                                        placeholder="john.doe" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="formtabs-email" class="form-control"
                                            placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="formtabs-email2" />
                                        <span class="input-group-text" id="formtabs-email2">@example.com</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formtabs-password">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="formtabs-password" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="formtabs-password2" />
                                            <span class="input-group-text cursor-pointer" id="formtabs-password2"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formtabs-confirm-password">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="formtabs-confirm-password" class="form-control"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="formtabs-confirm-password2" />
                                            <span class="input-group-text cursor-pointer"
                                                id="formtabs-confirm-password2"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-twitter">Twitter</label>
                                    <input type="text" id="formtabs-twitter" class="form-control"
                                        placeholder="https://twitter.com/abc" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-facebook">Facebook</label>
                                    <input type="text" id="formtabs-facebook" class="form-control"
                                        placeholder="https://facebook.com/abc" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-google">Google+</label>
                                    <input type="text" id="formtabs-google" class="form-control"
                                        placeholder="https://plus.google.com/abc" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-linkedin">Linkedin</label>
                                    <input type="text" id="formtabs-linkedin" class="form-control"
                                        placeholder="https://linkedin.com/abc" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-instagram">Instagram</label>
                                    <input type="text" id="formtabs-instagram" class="form-control"
                                        placeholder="https://instagram.com/abc" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="formtabs-quora">Quora</label>
                                    <input type="text" id="formtabs-quora" class="form-control"
                                        placeholder="https://quora.com/abc" />
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{--  @component('contents.customer-businesses.modal')
    @endcomponent  --}}
@endsection
