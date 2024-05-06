<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" data-theme="theme-default" data-assets-path="/dashboard/assets/"
    data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    @include('dashboard.partials.links')
    @yield('css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('dashboard.partials.sidebar')

            <!-- Layout container -->
            <div class="layout-page">

                @include('dashboard.partials.nav')


                <!-- Content wrapper -->
                <div class="content-wrapper">

                    @include('dashboard.partials.toaster')


                    @yield('content')

                    @include('dashboard.partials.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('dashboard.partials.scripts')

    @yield('js')


</body>

</html>
