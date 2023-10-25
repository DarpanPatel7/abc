@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/modules/app-access-roles.js') }}"></script>
    <script src="{{ asset('assets/js/modules/modal-add-role.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Role List</h4>

    <p>A role provided access to predefined menus and features so that depending on <br> assigned role an administrator can
        have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-4">

        @if (!empty($roles))
            @php $i=1; @endphp
            @foreach ($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-normal">Total 4 users</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/5.png') }}"
                                            alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="Allen Rieske" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/12.png') }}"
                                            alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/6.png') }}"
                                            alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/15.png') }}"
                                            alt="Avatar">
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        title="John Doe" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('assets/img/avatars/1.png') }}"
                                            alt="Avatar">
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $role->name }}</h4>
                                    <a href="javascript:;" class="role-edit-modal editRole"
                                        data-url="{{ url('roles/' . Crypt::Encrypt($role->id) . '/edit') }}"><small>Edit
                                            Role</small></a>
                                </div>
                                <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{ asset('assets/img/illustrations/lady-with-laptop-' . $configData['style'] . '.png') }}"
                                class="img-fluid" alt="Image" width="100"
                                data-app-light-img="illustrations/lady-with-laptop-light.png"
                                data-app-dark-img="illustrations/lady-with-laptop-dark.png">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                class="btn btn-primary mb-3 text-nowrap add-new-role">Add New Role</button>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-sm me-3">
                                                    <img src="{{ $employee->ProfilePhotoPath ?? '' }}" alt="Avatar"
                                                        class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="#" class="text-body text-truncate"><span
                                                        class="fw-semibold">{{ $employee->name ?? '' }}</span></a>
                                                <small class="text-muted">{{ $employee->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (!empty($employee->getRoleNames()))
                                            @foreach ($employee->getRoleNames() as $v)
                                                <span class="btn btn-info btn-sm">{{ $v }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="{{ $employee->badgeStatus ?? '' }}">{{ $employee->stringStatus ?? '' }}</span>
                                    </td>
                                    <td>
                                        <div class="d-inline-block text-nowrap">
                                            <button class="btn btn-sm btn-icon assignRole"
                                                data-url="{{ url('roles.getRole/' . Crypt::Encrypt($employee->id)) }}"><i
                                                    class="bx bx-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->
@endsection

@section('modal')
    @component('contents.roles.modal', ['module_permissions' => $module_permissions])
    @endcomponent
@endsection
