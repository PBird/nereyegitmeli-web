<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    @include("user.layouts.head")

    <body>
        <div id="fh5co-wrapper">
        <div id="fh5co-page">
        <div id="fh5co-header">
           @include("user.layouts.header")

        </div>

    @section("main-content")
        @show

    <script src="{{asset('user/js/jquery.min.js')}}"></script>
    <!-- jQuery Easing -->
    <script src="{{asset('user/js/jquery.easing.1.3.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('user/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('user/js/jquery.waypoints.min.js')}}"></script>
    <!-- Stellar -->
    <script src="{{asset('user/js/jquery.stellar.min.js')}}"></script>
    <!-- Superfish -->
    <script src="{{asset('user/js/hoverIntent.js')}}"></script>
    <script src="{{asset('user/js/superfish.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('user/js/main.js')}}"></script>

    @section("scripts")
        @show

    </body>

    @include("user.layouts.footer")


</html>

