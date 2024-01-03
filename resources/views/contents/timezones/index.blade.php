@extends('layouts/layoutMaster')

@section('title', 'Timezone')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/modules/timezones.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Timezone List</h4>

    <!-- Timezone List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatableTimezone table border-top" data-url="{{ route('timezones.index') }}">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>UTC Offset</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.timezones.modal')
    @endcomponent
@endsection
