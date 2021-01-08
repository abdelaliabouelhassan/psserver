<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <link rel="shortcut icon" href="/dist/images/favicon.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="/dist/vendors/fontawesome/css/all.min.css"/>

        <link rel="stylesheet" href="/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="/dist/vendors/simple-line-icons/css/simple-line-icons.css">
        <!-- END Template CSS-->



<!-- include summernote css/js -->


        <!-- START: Page CSS-->
        @yield('styles')
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="/dist/css/main.css">
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->
    <body class="@yield('class')">
        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->
        @yield('body')
        <!-- START: Back to top-->
        <a href="#" class="scrollup text-center">
            <i class="icon-arrow-up"></i>
        </a>
        <!-- END: Back to top-->
        <!-- START: Template JS-->

        <script src="/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="/dist/vendors/moment/moment.js"></script>
        <script src="/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- END: Template JS-->
        <!-- START: APP JS-->
        <script src="/dist/js/app.js"></script>
        <!-- END: APP JS-->

        <!-- START: Page JS-->
        @yield('script')
        <!-- END: Page JS-->
    </body>
</html>
