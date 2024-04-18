@extends('layouts/layoutMaster')

@section('title', 'Employee List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <style>
        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
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
        var getStateByCountry_url = '{{ url("employees.getStateByCountry") }}';
    </script>
    <script src="{{ asset('assets/js/modules/employee.js') }}"></script>
    <script src="{{ asset('assets/js/modules/export.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Employee List</h4>

    <!-- Users List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatableEmployee table border-top" data-url="{{ route('employees.index') }}">
                <thead>
                    <tr>
                        <th class="sorting_disabled"></th>
                        <th>No</th>
                        <th>User</th>
                        <td>Employee No</td>
                        <td>Designation</td>
                        <td>Date Of Birth</td>
                        <td>Status</td>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.employees.modal', ['designations' => $designations ?? [], 'countries' => $countries ?? [], 'languages' => $languages ?? [], 'timezones' => $timezones ?? [], 'currencies' => $currencies ?? []])
    @endcomponent
@endsection
