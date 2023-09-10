@extends('layouts/layoutMaster')

@section('title', 'Employee List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
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
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/employee.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Employee List</h4>
    
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
            <table class="datatables-employees table border-top">
                <thead>
                    <tr>
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
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.employees.modal') 
    @endcomponent
@endsection
