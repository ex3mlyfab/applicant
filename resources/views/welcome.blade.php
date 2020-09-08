<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Pentacare Hospital </title>
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="{{asset('backend')}}/assets/images/favicons/favicon.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
        <link rel="stylesheet" id="css-main" href="{{asset('backend')}}/assets/css/oneui.min.css">
        <style>
           body{
                background: linear-gradient(rgba(15,34,99, 0.4), rgba(15,34,99, 0.4)), url('{{asset('backend')}}/images/background/WhatsApp Image 2020-01-20 at 20.38.18.jpeg');
                background-repeat: repeat;
                background-size: cover;
                height: 100vh;
                font-family: "Tangerine";
            }

            #loginBtn:hover {
                color: white;
                background: transparent;
                border: 1px solid rgba(15,34,99);
                border-radius: 5px;
            }
            #loginBtn {
                color: white;
                background: rgba(15,34,99);
                border: 0px;
                border-radius: 5px;
            }
            #logo {
                border-radius: 15px;
            }
        </style>
    </head>
    <body>
        <div id="page-container">
            <main id="main-container">
                <div class="bg-image">
                    <div class="hero">
                        <div class="hero-inner">
                            <div class="content content-full">
                                <div class="row justify-content-center">
                                    <div class="col-md-6 py-3 text-center">
                                        <img height="120px" id="logo" src="{{asset('backend')}}/images/pentacare.png" alt="">
                                            <div class="push mt-3" id="welcome">
                                            <a class="font-w550 font-size-h1" href="/">
                                                <span class="text-white mt-1">
                                                   <span style="font-size: 35px"> Welcome !!! </span> <br />
                                                   <span style="font-size: 50px"> Administrator</span>
                                            </a>
                                        </div>
                                        <a class="btn btn-sm font-weight-normal py-2 px-3 btn-outline-success text-white" id="loginBtn">
                                            Login <i class="fa fa-fw fa-sign-in-alt mr-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="{{asset('backend')}}/assets/js/oneui.core.min.js"></script>
        <script src="{{asset('backend')}}/assets/js/oneui.app.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
        <script>
            gsap.from("#logo", {duration: 3, x: 300, opacity: 0, scale: 0.5});
            gsap.from("#welcome", {duration: 3, y: 300, opacity: 0, scale: 0.5});
            gsap.from(".btn", {duration: 3, y: 100, scale: 0.5});
        </script>
    </body>
</html>
