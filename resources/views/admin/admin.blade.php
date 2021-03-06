<!doctype html>
<html lang="en"></html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Pentacare|@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link rel="shortcut icon" href="{{asset('backend')}}/assets/media/favicons/favicon.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
        <link rel="stylesheet" id="css-main" href="{{asset('backend')}}/assets/css/oneui.min.css">
        @yield('head_css')
        <style>
            .pentacare-bg{
                background: rgba(255, 255, 255, 0.94);
                border-radius: 10px;
            }

        </style>
    </head>
    <body>

        <div id="page-container" style="background: rgb(51, 70, 128)" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">
@include('admin.partials.sidebar')
@include('admin.partials.header')
<!-- Main Container -->
<main id="main-container" style="background: linear-gradient(rgba(0,0,0,.3), rgba(0,0,0,.5)), url('{{asset('backend')}}/images/penta.jpeg') no-repeat center center; background-size: cover;">
    <div id="app">

    @yield('content')
    </div>
</main>
@include('admin.partials.footer')
@include('admin.partials.modal')
</div>

<script src="{{asset('backend')}}/assets/js/oneui.core.min.js"></script>
<script src="{{ asset('backend')}}/assets/js/oneui.app.min.js"></script>
<script src="{{ asset('backend')}}/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<script>
    $(function(){
        $('label').css("text-transform", "uppercase");
        $('form'). attr('autocomplete', 'off');
        function activityWatcher(){

//The number of seconds that have passed
//since the user was active.
var secondsSinceLastActivity = 0;

//Five minutes. 60 x 5 = 300 seconds.
var maxInactivity = (60 * 5);

//Setup the setInterval method to run
//every second. 1000 milliseconds = 1 second.
setInterval(function(){
    secondsSinceLastActivity++;
    console.log(secondsSinceLastActivity + ' seconds since the user was last active');
    //if the user has been inactive or idle for longer
    //then the seconds specified in maxInactivity
    if(secondsSinceLastActivity > maxInactivity){
        console.log('User has been inactive for more than ' + maxInactivity + ' seconds');
        //Redirect them to your logout.php page.
        location.href = 'logout.php';
    }
}, 1000);

//The function that will be called whenever a user is active
function activity(){
    //reset the secondsSinceLastActivity variable
    //back to 0
    secondsSinceLastActivity = 0;
}

//An array of DOM events that should be interpreted as
//user activity.
var activityEvents = [
    'mousedown', 'mousemove', 'keydown',
    'scroll', 'touchstart'
];

//add these events to the document.
//register the activity function as the listener parameter.
activityEvents.forEach(function(eventName) {
    document.addEventListener(eventName, activity, true);
});
activityWatcher();


}

    });
</script>
@yield('foot_js')

@include('admin.partials.flash')

</body>
</html>
