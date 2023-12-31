<!DOCTYPE html>

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}"
    class="{{ $configData['style'] }}-style {{ $navbarFixed ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}"
    dir="{{ $configData['textDirection'] }}"
    data-theme="{{ $configData['theme'] === 'theme-semi-dark' ? ($configData['layout'] !== 'horizontal' ? $configData['theme'] : 'theme-default') : $configData['theme'] }}"
    data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel"
    data-template="{{ $configData['layout'] . '-menu-' . $configData['theme'] . '-' . $configData['style'] }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') |
        {{ config('global.templateName') ? config('global.templateName') : 'TemplateName' }} -
        {{ config('global.templateSuffix') ? config('global.templateSuffix') : 'TemplateSuffix' }}</title>
    <meta name="description"
        content="{{ config('global.templateDescription') ? config('global.templateDescription') : '' }}" />
    <meta name="keywords"
        content="{{ config('global.templateKeyword') ? config('global.templateKeyword') : '' }}">
    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Canonical SEO -->
    <link rel="canonical" href="{{ config('global.productPage') ? config('global.productPage') : '' }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />


    <!-- Include Styles -->
    @include('layouts/sections/styles')

    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('layouts/sections/scriptsIncludes')
</head>

<body>



    <!-- Layout Content -->
    @yield('layoutContent')
    <!--/ Layout Content -->



    <!-- Include Scripts -->
    @include('layouts/sections/scripts')
    <script>
        // show toast noti after page refresh using session
        @if (Session::has('success'))
            $.showToastr("{{ Session::get('success') }}", "success");
            {{ Session::forget('success') }}
        @endif
        @if (Session::has('error'))
            $.showToastr("{{ Session::get('error') }}", "error");
            {{ Session::forget('error') }}
        @endif
        @if (Session::has('warning'))
            $.showToastr("{{ Session::get('warning') }}", "warning");
            {{ Session::forget('warning') }}
        @endif
        @if (Session::has('info'))
            $.showToastr("{{ Session::get('info') }}", "info");
            {{ Session::forget('info') }}
        @endif
    </script>
</body>

</html>
