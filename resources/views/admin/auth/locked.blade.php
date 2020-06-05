<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Pentacare Hospital</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Pentacare Hospital created by successpath Solutions">
        <meta name="author" content="Success-path solutions">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Pentacare Hospital">
        <meta property="og:site_name" content="Pentacare">
        <meta property="og:description" content="Pentacare Hospital created by successpath Solutions ">
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


        <!-- END Stylesheets -->
    </head>
    <body>

        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('{{asset('public/backend')}}/assets/media/photos/photo34@2x.jpg');">
                    <div class="hero-static bg-black-50">
                        <div class="content">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4">
                                    <!-- Unlock Block -->
                                    <div class="block block-themed mb-0">
                                        <div class="block-header bg-danger">
                                            <h3 class="block-title">Account Locked</h3>
                                            <div class="block-options">
                                                <a class="btn-block-option" href="op_auth_signin.html" data-toggle="tooltip" data-placement="left" title="Sign In with another account">
                                                    <i class="fa fa-sign-in-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="block-content">
                                            <div class="p-sm-3 px-lg-4 py-lg-5 text-center">
                                                <img src="{{ Auth::user()->avatar ? asset('public/backend/images/avatar/'. Auth::user()->avatar) : asset('public/frontend/img/no_image.png')}}" alt="" class="img-avatar img-avatar96">
                                                <p class="font-w600 my-2">
                                                    {{ Auth::user()->email }}
                                                </p>

                                                <!-- Unlock Form -->
                                                <!-- jQuery Validation (.js-validation-lock class is initialized in js/pages/op_auth_lock.min.js which was auto compiled from _es6/pages/op_auth_lock.js) -->
                                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                                <form class="js-validation-lock" action="be_pages_auth_all.html" method="POST">
                                                    <div class="form-group py-3">
                                                        <input type="password" class="form-control form-control-lg form-control-alt" id="lock-password" name="lock-password" placeholder="Password..">
                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <div class="col-md-6 col-xl-5">
                                                            <button type="submit" class="btn btn-block btn-light">
                                                                <i class="fa fa-fw fa-lock-open mr-1"></i> Unlock
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END Unlock Form -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Unlock Block -->
                                </div>
                            </div>
                        </div>
                        <div class="content content-full font-size-sm text-white text-center">
                            <strong>OneUI 4.0</strong> &copy; <span data-toggle="year-copy">2018</span>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
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
        <script src="assets/js/oneui.core.min.js"></script>

        <!--
            OneUI JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="assets/js/oneui.app.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/op_auth_lock.min.js"></script>
    </body>
</html>