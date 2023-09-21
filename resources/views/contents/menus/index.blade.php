@extends('layouts/layoutMaster')

@section('title', 'Menu List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat|Roboto+Mono') $primary: #FFA71A $background: #263238 $contrast: rgba(0, 0, 0, 0.9) body background: $background font-family: 'Montserrat', sans-serif display: flex flex-direction: column justify-content: center align-items: center position: fixed height: 100% width: 100% margin: 0 overflow: hidden @media screen and (max-height: 375px) position: relative overflow: auto .card width: 80% @media screen and (max-width: 1200px) width: 100% #editorWrapper position: relative height: 100% min-height: 45vh @media (min-height: 600px) height: 55vh @media (min-height: 900px) height: 65vh #editor font-family: 'Roboto Mono', monospace font-size: 14px position: absolute top: 0 bottom: 0 left: 0 right: 0 .btn color: $contrast font-family: 'Russo One', sans-serif font-size: 1.2em font-weight: 200 letter-spacing: .15em line-height: 2.5 text-decoration: none text-transform: uppercase cursor: pointer padding: 0 1em position: relative width: 100% margin-bottom: 1em background-color: $primary &:hover background-color: darken($primary, 15%)
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/ui-modals.js') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
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
