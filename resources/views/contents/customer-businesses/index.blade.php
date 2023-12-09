@extends('layouts/layoutMaster')

@section('title', 'Customer Business List')

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
    <script src="{{ asset('assets/js/modules/customer-business.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-2">Customer Business List</h4>

    <!-- Customer Businesses List Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-customer-businesses table border-top">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($customer_businesses))
                        @php $i=1; @endphp
                        @foreach ($customer_businesses as $customer_business)
                            <tr>
                                <!-- <td class="control">{{ $i++; }}</td> -->
                                <td>
                                    {{ $customer_business->name ?? '' }}
                                </td>
                                <td>
                                    <span class="{{ $customer_business->badgeStatus ?? '' }}">{{ $customer_business->stringStatus ?? '' }}</span>
                                </td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <button class="btn btn-sm btn-icon editCustomerBusiness" data-url="{{ url('customer-businesses/'.Crypt::Encrypt($customer_business->id).'/edit') }}"><i class="bx bx-edit"></i></button>
                                        <button class="btn btn-sm btn-icon deleteCustomerBusiness" data-url="{!! url('customer-businesses/'.Crypt::Encrypt($customer_business->id)) !!}"><i class="bx bx-trash"></i></button>
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
    @component('contents.customer-businesses.modal')
    @endcomponent
@endsection
