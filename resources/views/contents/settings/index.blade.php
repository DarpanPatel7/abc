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

    <!-- Form with Tabs -->
    <div class="row">
        <div class="col">
            <h6 class="mt-4"> Form with Tabs </h6>
            <div class="card mb-3" id="tab-content">
                <div class="card-header border-bottom">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#form-tabs-vertical"
                                role="tab" aria-selected="true">Vertical Menu</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-horizontal"
                                role="tab" aria-selected="true">Horizontal Menu</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="form-tabs-vertical" role="tabpanel">
                        {!! Form::open(array('route' => 'settings.saveVerticalMenu','method'=>'POST','id'=>'saveVerticalMenuForm','class'=>'restrict-enter')) !!}
                            <div class="row g-3">
                                <div class="col-md-12 inp-group">
                                    <label class="form-label" for="vertical_value">Vertical Menu Json</label>
                                    <textarea class="form-control" id="vertical_value" name="vertical_value" rows="30">{{ $vertical_menus->value ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="button" class="btn btn-primary me-sm-3 me-1" id="saveVerticalMenu">Save</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade" id="form-tabs-horizontal" role="tabpanel">
                        {!! Form::open(array('route' => 'settings.saveHorizontalMenu','method'=>'POST','id'=>'saveHorizontalMenuForm','class'=>'restrict-enter')) !!}
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="horizontal_value">Horizontal Menu Json</label>
                                    <textarea class="form-control" id="horizontal_value" name="horizontal_value" rows="30">{{ $horizontal_menus->value ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="pt-4">
                                <button type="button" class="btn btn-primary me-sm-3 me-1" id="saveHorizontalMenu">Save</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
