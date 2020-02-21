<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Pentacare| @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Pentacare Hospital created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Pentacare Hospital">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="Pentacare Hospital created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('public/backend')}}/assets/media/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="{{asset('public/backend')}}/assets/media/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/backend')}}/assets/media/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and OneUI framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('public/backend')}}/assets/css/oneui.min.css">
        @yield('head_css')

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
@include('admin.partials.sidebar')
@include('admin.partials.header')
<!-- Main Container -->
<main id="main-container">

    @yield('content')

</main>
<!-- END Main Container -->
@include('admin.partials.footer')
@include('admin.partials.modal')
</div>
<!-- END Page Container -->

<!--
    OneUI JS Core

    Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
    to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

    If you like, you could also include them separately directly from the assets/js/core folder in the following
    order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

    assets/js/core/jquery.min.js
    assets/js/core/bootstrap.bundle.min.js
    assets/js/core/simplebar.min.js
    assets/js/core/jquery-scrollLock.min.js
    assets/js/core/jquery.appear.min.js
    assets/js/core/js.cookie.min.js
-->
<script src="{{asset('public/backend')}}/assets/js/oneui.core.min.js"></script>

<!--
    OneUI JS

    Custom functionality including Blocks/Layout API as well as other vital and optional helpers
    webpack is putting everything together at assets/_es6/main/app.js
-->
<script src="{{asset('public/backend')}}/assets/js/oneui.app.min.js"></script>
<!-- Page JS Plugins -->
<script src="{{asset('public/backend')}}/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
@yield('foot_js')
@include('admin.partials.flash')

</body>
</html>