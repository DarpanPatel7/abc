@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Roles - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/modules/roles.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Role List</h4>
    <div class="d-flex justify-content-between">
        <div>
            <p>A role provided access to predefined menus and features so that depending on <br> assigned role an administrator can
                have access to what user needs.</p>
        </div>
        <div>
            <button class="btn btn-primary mb-3 text-nowrap" id="syncRolePermission" data-url="{{ route('roles.syncRolePermission') }}">Sync Roles & Permissions</button>
        </div>
    </div>
    <!-- Role cards -->
    <div class="row g-4">

        @if (!empty($roles))
            @php $i=1; @endphp
            @foreach ($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h6 class="fw-normal">Total {{ $role->users->count() }} users</h6>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @if (!empty($role->users))
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach ($role->users as $user)
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $user->name ?? '' }}" class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle" src="{{ $user->ProfilePhotoPath ?? '' }}"
                                                    alt="Avatar">
                                            </li>
                                            @if ($i++ > 9)
                                            break;
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ $role->name }}</h4>
                                    <a href="javascript:;" class="role-edit-modal editRole"
                                        data-url="{{ url('roles/' . Crypt::Encrypt($role->id) . '/edit') }}"><small>Edit
                                            Role</small></a>
                                </div>
                                @if ($role->name != 'Super Admin')
                                    <a href="javascript:;" class="text-muted deleteRole" data-url="{{ url('roles/' . Crypt::Encrypt($role->id)) }}"><i class="bx bx-trash"></i></a>
                                @endif
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
                    <table class="datatableRole table border-top" data-url="{{ route('roles.index') }}">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Assign Role</th>
                            </tr>
                        </thead>
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
