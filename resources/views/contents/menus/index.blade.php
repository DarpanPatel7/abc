@extends('layouts/layoutMaster')

@section('title', 'Menu List')

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
    <script src="{{ asset('assets/js/modules/menu.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Menu List</h4>

    <!-- Menus List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-menus table border-top">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Type</th>
                        <th>Json</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($menus))
                        @php $i=1; @endphp
                        @foreach ($menus as $menu)
                            <tr>
                                <!-- <td class="control">{{ $i++ }}</td> -->
                                <td>
                                    {{ $menu->type ?? '' }}
                                </td>
                                <td>
                                    {!! Str::limit($menu->json_menu, 80, ' ...') !!}
                                </td>
                                <td>
                                    <span class="{{ $menu->badgeStatus ?? '' }}">{{ $menu->stringStatus ?? '' }}</span>
                                </td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon editMenu"
                                            data-url="{{ url('menus/' . Crypt::Encrypt($menu->id) . '/edit') }}"><i
                                                class="bx bx-edit"></i></button>
                                        <button class="btn btn-sm btn-icon deleteMenu" data-url="{!! url('menus/' . Crypt::Encrypt($menu->id)) !!}"><i
                                                class="bx bx-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @component('contents.menus.modal')
    @endcomponent
@endsection
