@extends('layouts/layoutMaster')

@section('title', 'Admin Menu List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script type="text/javascript">
        var getParentMenuByChild_url = '{{ url("admin-menus.getParentMenuByChild") }}';
    </script>
    <script src="{{ asset('assets/js/modules/admin-menu.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Admin Menu List</h4>

    <!-- Admin Menus List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatableAdminMenu table border-top" data-url="{{ route('admin-menus.index') }}">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu Name</th>
                        {{--  <th>Menu Type</th>
                        <th>Parent Menu</th>  --}}
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.admin-menus.modal', ['menu_types' => $menu_types ?? []])
    @endcomponent
@endsection
