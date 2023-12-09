@extends('layouts/layoutMaster')

@section('title', 'Designation List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/extended-ui-sweetalert2.js')}}"></script>
    <script src="{{ asset('assets/js/modules/designation.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Designation List</h4>

    <!-- Designations List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-designations table border-top">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($designations))
                        @php $i=1; @endphp
                        @foreach ($designations as $designation)
                            <tr>
                                <!-- <td class="control">{{ $i++; }}</td> -->
                                <td>
                                    {{ $designation->name ?? '' }}
                                </td>
                                <td>
                                    <span class="{{ $designation->badgeStatus ?? '' }}">{{ $designation->stringStatus ?? '' }}</span>
                                </td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon editDesignation" data-url="{{ url('designations/'.Crypt::Encrypt($designation->id).'/edit') }}"><i class="bx bx-edit"></i></button>
                                        <button class="btn btn-sm btn-icon deleteDesignation" data-url="{!! url('designations/'.Crypt::Encrypt($designation->id)) !!}"><i class="bx bx-trash"></i></button>
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
    @component('contents.designations.modal')
    @endcomponent
@endsection
