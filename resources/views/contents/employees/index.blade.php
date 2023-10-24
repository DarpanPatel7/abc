@extends('layouts/layoutMaster')

@section('title', 'Employee List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <style>
        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/modules/employee.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script type="text/javascript">
        var defaultImage = "{{ url('assets/img/default-pfp.png') }}";
    </script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Employee List</h4>

    <!-- Users List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-employees table border-top">
                <thead>
                    <tr>
                        <td>User</td>
                        <td>Employee No</td>
                        <td>Role</td>
                        <td>Designation</td>
                        <td>Date Of Birth</td>
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
                                {{ $employee->employee_no ?? '' }}
                            </td>
                            <td>
                                @if (!empty($employee->getRoleNames()))
                                    @foreach ($employee->getRoleNames() as $v)
                                        <span class="btn btn-info btn-sm">{{ $v }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{ $employee->Designation->name ?? '' }}
                            </td>
                            <td>{{ $employee->Dob ?? '' }}</td>
                            <td>
                                <span
                                    class="{{ $employee->badgeStatus ?? '' }}">{{ $employee->stringStatus ?? '' }}</span>
                            </td>
                            <td>
                                <div class="d-inline-block text-nowrap">
                                    <button class="btn btn-sm btn-icon editEmployee"
                                        data-url="{{ url('employees/' . Crypt::Encrypt($employee->id) . '/edit') }}"><i
                                            class="bx bx-edit"></i></button>
                                    <button class="btn btn-sm btn-icon deleteEmployee" data-url="{!! url('employees/' . Crypt::Encrypt($employee->id)) !!}"><i
                                            class="bx bx-trash"></i></button>
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
    @component('contents.employees.modal', ['designations' => $designations ?? []])
    @endcomponent
@endsection
