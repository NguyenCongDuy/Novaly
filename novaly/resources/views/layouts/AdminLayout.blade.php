<!DOCTYPE html>
<html lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/"
    data-template="vertical-menu-template">

@include('layouts.blocks.head')

<body>

<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP"
        height="0" width="0"
        style="display:none;visibility:hidden">
    </iframe>
</noscript>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include('layouts.blocks.aside')

        <div class="layout-page">
            @include('layouts.blocks.nav')

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    @yield('content')
                </div>

                @include('layouts.blocks.footer')

                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
</div>

{{-- JS --}}
{{-- Core --}}
<script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('vendor/js/bootstrap.js') }}"></script>

{{-- Helpers + Config --}}
<script src="{{ asset('vendor/js/helpers.js') }}"></script>
{{-- <script src="{{ asset('vendor/js/config.js') }}"></script> --}}

{{-- Libs --}}
<script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>

{{-- Menu --}}
<script src="{{ asset('vendor/js/menu.js') }}"></script>

{{-- Charts --}}
<script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>

{{-- Main --}}
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- Page --}}
{{-- <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script> --}}

@stack('scripts')

</body>
</html>