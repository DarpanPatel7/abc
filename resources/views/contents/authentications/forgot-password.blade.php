@php
    $customizerHidden = 'customizer-hide';
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Forgot Password')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/modules/authentications/forgot-password.js') }}"></script>
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    @include('_partials.macros')
                                </span>
                                <span class="app-brand-text demo h3 mb-0 fw-bold">
                                    {{ config('global.templateName') }}
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Forgot Password? 🔒</h4>
                        <p class="mb-4">Enter your email and we will send you instructions to reset your password</p>
                        {!! html()->form('POST')->route('password.email')->id('forgot-password-form')->class('restrict-enter mb-3')->open() !!}
                            <div class="mb-3 inp-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
                            </div>
                            <button class="btn btn-primary w-100" type="button" id="forgot-password">Send reset link</button>
                        {!! html()->form()->close() !!}
                        <div class="text-center">
                            <a href="{{ url('login') }}" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
