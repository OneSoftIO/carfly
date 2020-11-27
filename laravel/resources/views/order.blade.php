<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(View::hasSection('title'))
        <title>CarFly.lt - @yield('title')</title>
    @else
        <title>CarFly.lt - @lang('page.title')</title>
    @endif
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="shortcut icon" href="{{asset('ico/favicon.ico')}}">
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/prettyphoto/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/owl-carousel2/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/owl-carousel2/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/swiper/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/theme.css?ver='.config('app.versions.css'))}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.date.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.css?ver='.config('app.versions.css'))}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css?ver='.config('app.versions.css'))}}" rel="stylesheet">

@yield('style')
<!-- Head Libs -->
    <script src="{{asset('assets/plugins/modernizr.custom.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="{{asset('assets/plugins/iesupport/html5shiv.js')}}"></script>
    <script src="{{asset('assets/plugins/iesupport/respond.min.js')}}"></script>
    <![endif]-->
    @if(config('app.env') === 'production')
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5a37848abbdfe97b137fc163/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
    <script type="text/javascript">
        window.smartlook||(function(d) {
            var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
            var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
            c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', '016805e84588318b252f3f0f81e5f0ef1b189e6e');
    </script>
    @endif
</head>
<body  class="wide">
<div id="preloader">
    <div id="preloader-status">
        <img src="{{asset('images/logo.svg')}}" alt="carfly.lt">
    </div>
</div>
@yield('header')
<!-- WRAPPER -->
<div class="wrapper">
    <div class="content-area">
        @yield('content')
    </div>
    <!-- /CONTENT AREA -->
</div>
<!-- /WRAPPER -->

<!-- JS Global -->
<script src="{{asset('assets/plugins/jquery/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/plugins/superfish/js/superfish.min.js')}}"></script>
<script src="{{asset('assets/plugins/prettyphoto/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('assets/plugins/owl-carousel2/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.sticky.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.easing.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery.smoothscroll.min.js')}}"></script>
<!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
<!--<script src="assets/plugins/wow/wow.min.js"></script>-->
<script>
    // WOW - animated content
    //new WOW().init();
</script>
<script src="{{asset('assets/plugins/swiper/js/swiper.jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/datetimepicker/js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{asset('assets/js/picker.js')}}"></script>
<script src="{{asset('assets/js/picker.date.js')}}"></script>



@yield('scripts')
@yield('script')
<!-- JS Page Level -->
<script src="{{asset('assets/js/theme-ajax-mail.js?ver='.config('app.versions.js'))}}"></script>
<script src="{{asset('assets/js/theme.js?ver='.config('app.versions.js'))}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

</body>
</html>