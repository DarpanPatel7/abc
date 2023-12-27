@extends('layouts/layoutMaster')

@section('title', 'Settings')

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
    <script src="{{ asset('assets/js/modules/setting.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Settings</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Vertical Menu</h5>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'settings.saveVerticalMenu',
                        'method' => 'POST',
                        'id' => 'saveVerticalMenuForm',
                        'class' => 'restrict-enter',
                    ]) !!}
                        <div class="mb-3 inp-group">
                            <label class="form-label" for="vertical_value">Vertical Menu Json</label>
                            <textarea class="form-control" id="vertical_value" name="vertical_value" rows="20">{{ $vertical_menus->value ?? '' }}</textarea>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveVerticalMenu">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Horizontal Menu</h5>
                </div>
                <div class="card-body">
                    {!! Form::open([
                        'route' => 'settings.saveHorizontalMenu',
                        'method' => 'POST',
                        'id' => 'saveHorizontalMenuForm',
                        'class' => 'restrict-enter',
                    ]) !!}
                        <div class="mb-3 inp-group">
                            <label class="form-label" for="horizontal_value">Horizontal Menu Json</label>
                            <textarea class="form-control" id="horizontal_value" name="horizontal_value" rows="20">{{ $horizontal_menus->value ?? '' }}</textarea>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveHorizontalMenu">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
