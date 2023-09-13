@extends('layouts/layoutMaster')

@section('title', 'Permission - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />  --}}
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    {{--  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>  --}}
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-access-permission.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Permissions List</h4>

    <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>


    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table border-top">
                <thead>
                    <tr>
                        <th class="control"></th>
                        <th></th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($permissions))
                        @php $i=1; @endphp
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="control"></td><td></td>
                                <td>
                                    {{ $permission->flag ?? '' }}
                                </td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon editDesignation" data-url="{{ url('permissions/'.Crypt::Encrypt($permission->id).'/edit') }}"><i class="bx bx-edit"></i></button>
                                        <button class="btn btn-sm btn-icon deleteDesignation" data-url="{!! url('permissions/'.Crypt::Encrypt($permission->id)) !!}"><i class="bx bx-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->
@endsection

@section('modal')
    @component('contents.permissions.modal')
    @endcomponent
@endsection
