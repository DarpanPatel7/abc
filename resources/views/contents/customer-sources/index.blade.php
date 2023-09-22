@extends('layouts/layoutMaster')

@section('title', 'Customer Source List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/customer-source.js') }}"></script>
    <script src="{{asset('assets/js/ui-modals.js')}}"></script>
    <script src="{{asset('assets/js/extended-ui-sweetalert2.js')}}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Customer Source List</h4>

    <!-- Customer Sources List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-customer-sources table border-top">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($customer_sources))
                        @php $i=1; @endphp
                        @foreach ($customer_sources as $customer_sources)
                            <tr>
                                <!-- <td class="control">{{ $i++; }}</td> -->
                                <td>
                                    {{ $customer_sources->name ?? '' }}
                                </td>
                                <td>
                                    <span class="{{ $customer_sources->badgeStatus ?? '' }}">{{ $customer_sources->stringStatus ?? '' }}</span>
                                </td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon editCustomerSource" data-url="{{ url('customer-sources/'.Crypt::Encrypt($customer_sources->id).'/edit') }}"><i class="bx bx-edit"></i></button>
                                        <button class="btn btn-sm btn-icon deleteCustomerSource" data-url="{!! url('customer-sources/'.Crypt::Encrypt($customer_sources->id)) !!}"><i class="bx bx-trash"></i></button>
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
    @component('contents.customer-sources.modal')
    @endcomponent
@endsection
