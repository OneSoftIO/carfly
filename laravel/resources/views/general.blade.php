<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="verify-paysera" content="6b44c672bae47e114198a2a9ceefd50d">
    @if(View::hasSection('meta-description'))
    <meta name="description" content="@yield('meta-description')">
    @endif
    @if(View::hasSection('meta-keywords'))
    <meta name="keywords" content="@yield('meta-keywords')">
    @endif

    @if(View::hasSection('title'))
    <title>CarFly.lt - @yield('title')</title>
    @else
    <title>CarFly.lt - @lang('page.title')</title>
    @endif
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon" />
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
    <link href="{{asset('assets/css/main.css?ver='.config('app.versions.css'))}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.date.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/default.css')}}" rel="stylesheet">

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
<body  class="wide @yield('head') {{Request::url() == route('main.page')?'index':null}}">
<div id="preloader">
    <div id="preloader-status">
        <img src="{{asset('images/logo.svg')}}" alt="{{config('app.name')}}">
    </div>
</div>
<div id="cookie_block" style="display:none;">
    <div class="cookie_cont">
        <div class="cookie_text">@lang('page.cookie.text')<a href="@lang('page.cookie.url')" target="_blank">@lang('page.cookie.url_title')</a>.</div>
        <div class="cookie_btn_cell">
            <button class="btn btn-theme btn-radio bt-dark" type="button" onclick="accept_eu_cookie();">@lang('page.cookie.btn')</button>
        </div>
    </div>
</div>
<div class="wrapper">
    <header class="header fixed">
        <div class="header-wrapper">
            <div class="container">
                <div class="logo">
                    <a href="{{route('main.page')}}"><img src="{{asset('images/logo.svg')}}" alt="Rent It"/></a>
                </div>
                <div class="header-middle-wrapper header-middle-wrapper-main">
                    <a href="tel:+370640 80000" class="phone-number">+370 640 80000</a>
                    <ul class="social-icons">
                        @if(isset($socials->option_value['facebook']))
                            <li><a href="{{$socials->option_value['facebook']}}" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if(isset($socials->option_value['twitter']))
                            <li><a href="{{$socials->option_value['twitter']}}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if(isset($socials->option_value['instagram']))
                            <li class=""><a href="{{$socials->option_value['instagram']}}" class="instagram"><i class="fa fa-instagram"></i></a></li>
                        @endif
                        @if(isset($socials->option_value['pinterest']))
                            <li><a href="{{$socials->option_value['pinterest']}}" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                        @endif
                    </ul>
                </div>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                @if(count(LaravelLocalization::getSupportedLocales()) > 1)
                <ul class="lang">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li {{(Lang::locale() == $localeCode)? 'class=active' : null}}>
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{$localeCode}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                @endif
                <div class="nav-holder">
                    <ul class="nav sf-menu">
                        @if(Request::url() !== route('main.page'))
                        <li><a href="{{route('main.page')}}">@lang('page.menu.main')</a></li>
                        @endif
                        <li class="{{(Request::url() == route('cars.page'))? 'active' : null}}"><a href="{{route('cars.page')}}">@lang('page.vehicles')</a></li>
                        <li class="{{(Request::url() == route('other.page', 'nuomos-salygos'))? 'active' : null}}"><a href="{{route('other.page', 'nuomos-salygos')}}">@lang('page.menu.conditions')</a></li>
                        <li class="{{(Request::url() == route('blog.page'))? 'active' : null}}"><a href="{{route('blog.page')}}">@lang('page.articles')</a></li>
                        <li class="{{(Request::url() == route('contact.page'))? 'active' : null}}"><a href="{{route('contact.page')}}">@lang('page.contact')</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </header>
    <div class="content-area">
    @yield('content')
    </div>
    @yield('footer')
    <!-- FOOTER -->
    <footer class="footer">
        @yield('footer_top')
        <div class="footer-meta">
            <div class="container">
                <div class="row">
                    @if($otherPages)
                    <div class="col-sm-12">
                        <ul class="other-pages">
                            @foreach($otherPages as $page)
                            <li><a href="{{route('other.page', $page->translation->slug)}}">{{$page->translation->post_title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="col-sm-12">
                        <p class="btn-row text-center">
                            @if(isset($socials->option_value['facebook']))
                                <a href="{{$socials->option_value['facebook']}}" target="_blank" class="btn btn-theme ripple-effect btn-icon-left facebook wow fadeInDown btn-radio" data-wow-offset="20" data-wow-delay="100ms"><i class="fa fa-facebook"></i>FACEBOOK</a>
                            @endif
                            @if(isset($socials->option_value['twitter']))
                                <a href="{{$socials->option_value['twitter']}}" target="_blank" class="btn btn-theme btn-icon-left ripple-effect twitter wow fadeInDown btn-radio" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-twitter"></i>TWITTER</a>
                            @endif
                            @if(isset($socials->option_value['instagram']))
                                <a href="{{$socials->option_value['instagram']}}" target="_blank" class="btn btn-theme btn-icon-left ripple-effect instagram wow fadeInDown btn-radio" data-wow-offset="20" data-wow-delay="200ms"><i class="fa fa-instagram"></i>INSTAGRAM</a>
                            @endif
                            @if(isset($socials->option_value['pinterest']))
                                <a href="{{$socials->option_value['pinterest']}}" target="_blank" class="btn btn-theme btn-icon-left ripple-effect pinterest wow fadeInDown btn-radio" data-wow-offset="20" data-wow-delay="300ms"><i class="fa fa-pinterest"></i>PINTEREST</a>
                            @endif
                            @if(isset($socials->option_value['google']))
                                <a href="{{$socials->option_value['google']}}" target="_blank" class="btn btn-theme btn-icon-left ripple-effect google wow fadeInDown btn-radio" data-wow-offset="20" data-wow-delay="400ms"><i class="fa fa-google"></i>GOOGLE</a>
                            @endif
                        </p>
                        <div class="copyright">@lang('page.copyright')</div>

                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

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
@yield('js')
<!-- JS Page Level -->
<script src="{{asset('assets/js/theme-ajax-mail.js?ver='.config('app.versions.js'))}}"></script>
<script src="{{asset('assets/js/theme.js?ver='.config('app.versions.js'))}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA-u2BKuoa_ZhBcMmgobChG_eqvYIWWOg&v=3.exp&amp;sensor=false"></script>

</body>
</html>
