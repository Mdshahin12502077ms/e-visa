<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

 <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jun 2025 18:58:27 GMT -->
<head>

    <meta charset="utf-8" />
    <title>Dashboard | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

  @include('Backend.Partial.style')


</head>

<body>

@include('Backend.Partial.header')


  <!-- /.modal -->
        <!-- ========== App Menu ========== -->
        @include('Backend.Partial.sidebar')

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
       @yield('content')
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    @include('Backend.Partial.js')

    @include('Backend.Partial.footer')


</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jun 2025 18:59:26 GMT -->
</html>
