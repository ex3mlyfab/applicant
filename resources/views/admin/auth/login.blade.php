<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Pentacare Hospital</title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="{{asset('backend')}}/assets/images/favicons/favicon.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
        <link rel="stylesheet" id="css-main" href="{{asset('backend')}}/assets/css/oneui.min.css">
        <style>
        body{
                background: linear-gradient(rgba(15,34,99, 0.4), rgba(15,34,99, 0.4)), url('{{asset('backend')}}/images/background/WhatsApp Image 2020-01-20 at 20.38.18.jpeg');
                background-repeat: repeat;
                background-size: cover;
                height: 100vh;
                font-family: "Tangerine";
        }

            button {
                color: white;
                background: rgb(51, 70, 128);
                border: 0px;
                border-radius: 5px;
            }
            button:hover {
                color: rgb(51, 70, 128);
                background: transparent;
                border: 1px solid rgb(51, 70, 128);
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div id="page-container">
            <main id="main-container">
                <div class="bg-image">
                    <div class="hero-static">
                        <div class="content">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6 col-xl-4  login-inner-form">
                                    <div class="block block-themed block-fx-shadow mb-0">
                                           <div class="block-header" style="background: rgb(51, 70, 128)">
                                            <h3 class="block-title">Log In to your department</h3>
                                        </div>
                                        <div class="block-content" style="background: rgba(255, 255, 255, 0.3)">
                                            <div class="p-sm-3 px-lg-4 py-lg-5">
                                                <h1 class="mb-2">Pentacare</h1>
                                                <p>Welcome, please login.</p>

                                            <form class="js-validation-signin" action="{{route('admin.login')}}" method="POST">
                                                @csrf
                                                    <div class="py-3">
                                                        <div class="form-group">
                                                            <div class="d-flex">
                                                                <i style="position: absolute; font-size: 16px; margin-top: 6px; color: rgb(51, 70, 128)" class="fas fa-user pl-2 py-2"></i>
                                                                <input type="email" class="form-control form-control-alt form-control-lg" style="padding-left: 33px; font-size: 16px;" id="login-username" name="email" placeholder="Username" required>
                                                            </div>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="d-flex">
                                                                <i style="position: absolute; font-size: 16px; color: rgb(51, 70, 128)" class="fas fa-lock pl-2 pt-3 py-2"></i>
                                                                <input id="password" type="password" class="form-control form-control-alt form-control-lg" style="padding-left: 33px; font-size: 16px;" id="login-password" name="password" placeholder="Password" required>
                                                                <i id="eye" style="position: absolute; cursor: pointer; color: rgb(51, 70, 128); margin-left: 340px;" class="fas fa-eye pt-3 py-2"></i>
                                                            </div>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="login-remember" name="remember">
                                                                <h1 style="font-size: 16px" class="custom-control-label font-w400 pt-1" for="login-remember">Remember Me</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6 col-xl-5">
                                                            <button type="submit" class="btn">
                                                                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 25px" class="text-white content content-full font-size-sm text-muted text-center">
                            <span style="font-size: 30px">Pentacare Hospital</span> &copy; <span style="font-size: 25px" data-toggle="year-copy">2020</span>
                        </div>
                    </div>
                </div>

            </main>
        </div>
        <script src="{{asset('backend')}}/assets/js/oneui.core.min.js"></script>
        <script src="{{asset('backend')}}/assets/js/oneui.app.min.js"></script>
        <script src="{{asset('backend')}}/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="{{asset('backend')}}/assets/js/pages/op_auth_signin.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
        <script>


        $('#eye').on('click', function(e){
        $('#eye').toggleClass("fa-eye-slash").toggleClass("fa-eye")
        if($("#eye").hasClass("fa-eye")){
            $("#password").attr("type", "password")
        }
        if($("#eye").hasClass("fa-eye-slash")){
            $("#password").attr("type", "text")
        }
        });
            gsap.from(".login-inner-form", {duration: 2, y: 300, opacity: 0, scale: 0, ease: "bounce"});
        </script>
    </body>
</html>
