@extends('layouts/layoutMaster')

@section('title', 'Employee List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-user-list.js') }}"></script>
    <script src="{{ asset('assets/js/helper.js') }}"></script>
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
    <script>
        var url = "{{ url('employee.store') }}";
        $(document).on('click', '#employee-submit', function() {
            $.easyAjax({
                url: url,
                type: "POST",
                buttonSelector: $(this),
                data: $("#addEmployeeForm").serialize(),
            })
        });
    </script>
@endsection

@section('content')

    <h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light">Employee /</span> List
  </h4>
    {{--  <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">21,459</h4>
                                <small class="text-success">(+29%)</small>
                            </div>
                            <small>Total Users</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-user bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Paid Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">4,567</h4>
                                <small class="text-success">(+18%)</small>
                            </div>
                            <small>Last week analytics </small>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class="bx bx-user-plus bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">19,860</h4>
                                <small class="text-danger">(-14%)</small>
                            </div>
                            <small>Last week analytics</small>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class="bx bx-group bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Pending Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                <small class="text-success">(+42%)</small>
                            </div>
                            <small>Last week analytics</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-user-voice bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- Users List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    {{--  <tr>
                        <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
                        <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 307px;" aria-label="User: activate to sort column ascending" aria-sort="descending">User</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 153px;" aria-label="Role: activate to sort column ascending">Role</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 105px;" aria-label="Plan: activate to sort column ascending">Plan</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 190px;" aria-label="Billing: activate to sort column ascending">Billing</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 108px;" aria-label="Status: activate to sort column ascending">Status</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Actions">Actions</th>
                    </tr>  --}}
                    {{--  <tr>
                        <th style="display: none;"></th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Plan</th>
                        <th>Billing</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- <th width="100px">Approved</th> -->
                    </tr>  --}}
                    <tr>
                        <td class="  control" tabindex="0" style="display: none;"></td>
                        <td>User</td>
                        <td>Role</td>
                        <td>Plan</td>
                        <td>Billing</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="control" style="display: none;"></td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            <img src="{{ url('assets\img\default-pfp.png'); }}" alt="Avatar" class="rounded-circle">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="text-body text-truncate"><span class="fw-semibold">{{ $employee->name ?? ''; }}</span></a>
                                        <small class="text-muted">{{ $employee->email ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-truncate d-flex align-items-center">
                                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                    <i class="bx bx-pie-chart-alt bx-xs"></i>
                                </span>Maintainer</span>
                            </td>
                            <td>
                                <span class="fw-semibold">Enterprise</span>
                            </td>
                            <td>Auto Debit</td>
                            <td>
                                <span class="badge bg-label-success">Active</span>
                            </td>
                            <td>
                                <div class="d-inline-block text-nowrap">
                                    <button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>
                                    <button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>
                                    <button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="dropdown-item">View</a>
                                        <a href="javascript:;" class="dropdown-item">Suspend</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{--  <tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="text-body text-truncate"><span class="fw-semibold">Yoko Pottie</span></a><small class="text-muted">ypottiec@privacy.gov.au</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"><i class="bx bx-user bx-xs"></i></span>Subscriber</span></td><td><span class="fw-semibold">Basic</span></td><td>Auto Debit</td><td><span class="badge bg-label-secondary">Inactive</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr>  --}}
                    {{--  <tr class="odd"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><img src="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle"></div></div><div class="d-flex flex-column"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="text-body text-truncate"><span class="fw-semibold">Wesley Burland</span></a><small class="text-muted">wburlandj@uiuc.edu</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-info w-px-30 h-px-30 me-2"><i class="bx bx-edit bx-xs"></i></span>Editor</span></td><td><span class="fw-semibold">Team</span></td><td>Auto Debit</td><td><span class="badge bg-label-secondary">Inactive</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr>  --}}
                    {{--  <tr class="even"><td class="  control" tabindex="0" style="display: none;"></td><td class="sorting_1"><div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3"><span class="avatar-initial rounded-circle bg-label-success">VK</span></div></div><div class="d-flex flex-column"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="text-body text-truncate"><span class="fw-semibold">Vladamir Koschek</span></a><small class="text-muted">vkoschek17@abc.net.au</small></div></div></td><td><span class="text-truncate d-flex align-items-center"><span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i class="bx bx-cog bx-xs"></i></span>Author</span></td><td><span class="fw-semibold">Team</span></td><td>Manual - Paypal</td><td><span class="badge bg-label-success">Active</span></td><td><div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button><button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu dropdown-menu-end m-0"><a href="http://localhost:8080/test/frest-admin-v4.1.0/laravel-version/full-version%20-%20Copy/public/app/user/view/account" class="dropdown-item">View</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div></td></tr>  --}}
                </tbody>
            </table>
        </div>
        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header border-bottom">
                <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="addEmployee pt-0" id="addEmployeeForm" onsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="employee_no">Employee No</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="employee_no" placeholder="123456" name="employee_no" aria-label="123456" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fullname">Full Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="current_address">Current Address</label>
                        <div class="input-group">
                            <textarea class="form-control" id="current_address" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="permanent_address">Permannet Address</label>
                        <div class="input-group">
                            <textarea class="form-control" id="permanent_address" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date of Birth</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                        </div>
                    </div>
                    {{--  <div class="mb-3">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Joining Date</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                        </div>
                    </div>  --}}
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-group">
                            <input type="text" id="email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="contact">Contact</label>
                        <input type="text" id="contact" class="form-control phone-mask"
                            placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                    </div>
                    <div class="mb-3">
                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                          <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                        </div>
                    </div>
                    {{--  <div class="mb-3">
                        <label class="form-label" for="country">Country</label>
                        <select id="country" class="select2 form-select">
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
                    </div>  --}}
                    {{--  <div class="mb-3">
                        <label class="form-label" for="user-role">User Role</label>
                        <select id="user-role" class="form-select">
                            <option value="subscriber">Subscriber</option>
                            <option value="editor">Editor</option>
                            <option value="maintainer">Maintainer</option>
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>  --}}
                    {{--  <div class="mb-4">
                        <label class="form-label" for="user-plan">Select Plan</label>
                        <select id="user-plan" class="form-select">
                            <option value="basic">Basic</option>
                            <option value="enterprise">Enterprise</option>
                            <option value="company">Company</option>
                            <option value="team">Team</option>
                        </select>
                    </div>  --}}
                    <button type="button" class="btn btn-primary me-sm-3 me-1" id="employee-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
