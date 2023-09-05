@extends('layouts/layoutMaster')

@section('title', 'Designation List')

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
    <script src="{{ asset('assets/js/designation.js') }}"></script>
    <script src="{{ asset('assets/js/helper.js') }}"></script>
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>
    <script>
        var url = "{{ route('designations.store') }}";
        $(document).on('click', '#designation-submit', function() {
            $.easyAjax({
                url: url,
                type: "POST",
                buttonSelector: $(this),
                data: $("#addDesignationForm").serialize(),
            })
        });
    </script>
@endsection

@section('content')

    <h4 class="py-3 breadcrumb-wrapper mb-4">
    <span class="text-muted fw-light">Designation /</span> List
  </h4>
    <!-- Designations List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-designations table border-top">
                <thead>
                    <tr>
                        <td class="  control" tabindex="0" style="display: none;"></td>
                        <td>Name</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($designations as $designation)
                        <tr>
                            <td class="control" style="display: none;"></td>
                            <td>
                                {{ $designation->name ?? '' }}
                            </td>
                            <td>
                                <span class="{{ $designation->badgeStatus ?? '' }}">Active</span>
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
        <!-- Offcanvas to add new user -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddDesignation" aria-labelledby="offcanvasAddDesignationLabel">
            <div class="offcanvas-header border-bottom">
                <h6 id="offcanvasAddDesignationLabel" class="offcanvas-title">Add Designation</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0">
                <form class="addDesignation pt-0" id="addDesignationForm" onsubmit="return false">
                    <div class="mb-3">
                        <label class="form-label" for="designation_name">Designation Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="designation_name" placeholder="Designation Name" name="designation_name" aria-label="Designation Name" />
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary me-sm-3 me-1" id="designation-submit">Submit</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
