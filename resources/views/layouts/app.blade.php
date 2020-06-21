<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="TURBOO">
    <meta name="keywords" content="admin template">
    <meta name="author" content="TURBOO">
    <title>Turboo</title>
    <link rel="apple-touch-icon" href="{{URL::asset('template/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('template/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/extensions/toastr.css')}}">

    <!-- END: Theme CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/ecommerce-cart.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/plugins/forms/checkboxes-radios.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/plugins/extensions/toastr.css')}}">

    <input type="hidden" value='{{ URL::route("update_notification_counter")}}' id= "updateNotificationCounter">
    <input type="hidden" value='{{ URL::route("orders_notification")}}' id= "ordersNotification">
    <script src="{{URL::asset('js/load_order_notification.js')}}" type="text/javascript"> </script>

    <input type="hidden" value='{{ URL::route("update_review_counter")}}' id= "updateReviewCounter">
    <input type="hidden" value='{{ URL::route("review_notification")}}' id= "reviewNotification">
    <script src="{{URL::asset('js/load_review_notification.js')}}" type="text/javascript"> </script>

@yield('header')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" @if(Auth::user()->role==\App\User::business)  href="{{route('dashboard')}}"   @else href="{{route('/')}}"  @endif>
                        <img class="brand-logo" alt="turbo" src="{{URL::asset('template/app-assets/images/logo/turboo.png')}}" style="width: 30px;height:30px"><h3 class="brand-text">Turboo</h3>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">

                    @if(\App\BusinessSubscription::subscription()->exists())
                       {{--{{ dd(\App\BusinessSubscription::where('business_id',Auth::id())->value('end_date')->subDays(7))}}--}}
                        @if(\App\BusinessSubscription::where('business_id',Auth::id())->value('end_date')->subDays(7)<\Carbon\Carbon::now())
                            <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><span class="danger"> <b>Your subscription will expire on: {{date('d-m-Y',strtotime(\App\BusinessSubscription::subscription()->value('end_date')))}}</b> </span>
                        @endif

                    @endif

                    {{--<li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>--}}
                    {{--<li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>--}}
                        {{--<ul class="mega-dropdown-menu dropdown-menu row p-1">--}}
                            {{--<li class="col-md-4 bg-mega p-2">--}}
                                {{--<h3 class="text-white mb-1 font-weight-bold">Mega Menu Sidebar</h3>--}}
                                {{--<p class="text-white line-height-2">Candy canes bonbon toffee. Cheesecake dragée gummi bears chupa chups powder bonbon. Apple pie cookie sweet.</p>--}}
                                {{--<button class="btn btn-outline-white">Learn More</button>--}}
                            {{--</li>--}}
                            {{--<li class="col-md-5 px-2">--}}
                                {{--<h6 class="font-weight-bold font-medium-2 ml-1">Admin Panel</h6>--}}
                                {{--<ul class="row mt-2">--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3" href="../ecommerce-menu-template" target="_blank"><i class="la la-shopping-cart font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-0">eCommerce</p>--}}
                                        {{--</a></li>--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3" href="../travel-menu-template" target="_blank"><i class="la la-plane font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-0">Travel</p>--}}
                                        {{--</a></li>--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mb-xl-3 mt-75 mt-xl-0" href="../hospital-menu-template" target="_blank"><i class="la la-stethoscope font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-0">Hospital</p>--}}
                                        {{--</a></li>--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="../crypto-menu-template" target="_blank"><i class="la la-bitcoin font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-50">Crypto</p>--}}
                                        {{--</a></li>--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="../support-menu-template" target="_blank"><i class="la la-tag font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-50">Support</p>--}}
                                        {{--</a></li>--}}
                                    {{--<li class="col-6 col-xl-4"><a class="text-center mb-2 mt-75 mt-xl-0" href="../bank-menu-template" target="_blank"><i class="la la-bank font-large-1 mr-0"></i>--}}
                                            {{--<p class="font-medium-2 mt-25 mb-50">Bank</p>--}}
                                        {{--</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="col-md-3">--}}
                                {{--<h6 class="font-weight-bold font-medium-2">Components</h6>--}}
                                {{--<ul class="row mt-1 mt-xl-2">--}}
                                    {{--<li class="col-12 col-xl-6 pl-0">--}}
                                        {{--<ul class="mega-component-list">--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-alerts.html" target="_blank">Alert</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-callout.html" target="_blank">Callout</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-buttons-basic.html" target="_blank">Buttons</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-carousel.html" target="_blank">Carousel</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                    {{--<li class="col-12 col-xl-6 pl-0">--}}
                                        {{--<ul class="mega-component-list">--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-dropdowns.html" target="_blank">Drop Down</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-list-group.html" target="_blank">List Group</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-modals.html" target="_blank">Modals</a></li>--}}
                                            {{--<li class="mega-component-item"><a class="mb-1 mb-xl-2" href="component-pagination.html" target="_blank">Pagination</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
                <ul class="nav navbar-nav float-right">
                    @if(Auth::user()->role==\App\User::business)
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                            <span class="badge badge-pill badge-danger badge-up badge-glow" id="order_notification"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-danger float-right m-0" ><div id="order_notification"></div> New</span>
                            </li>
                            <li class="scrollable-container media-list w-100" id="order_notification_dropdown"></li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{route('orders.index')}}">View All</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i>
                                <span class="badge badge-pill badge-warning badge-up badge-glow" id="review_notification"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-warning float-right m-0" ><div id="review_notification"></div> New</span>
                                </li>
                                <li class="scrollable-container media-list w-100" id="review_notification_dropdown"></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{route('review.index')}}">View All</a></li>
                            </ul>
                    </li>

                    {{--<li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i></a>--}}
                        {{--<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">--}}
                            {{--<li class="dropdown-menu-header">--}}
                                {{--<h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6><span class="notification-tag badge badge-warning float-right m-0">4 New</span>--}}
                            {{--</li>--}}
                            {{--<li class="scrollable-container media-list w-100">--}}
                                {{--<a href="javascript:void(0)">--}}
                                    {{--<div class="media">--}}
                                        {{--<div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span></div>--}}
                                        {{--<div class="media-body">--}}
                                            {{--<h6 class="media-heading">Margaret Govan</h6>--}}
                                            {{--<p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p><small>--}}
                                                {{--<time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                               {{--</li>--}}
                            {{--<li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}

                    @endif
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700"></span><span class="avatar avatar-online"><img src="{{URL::asset('template/app-assets/images/portrait/small/user.png')}}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('admin_edit_profile')}}"><i class="ft-user"></i> My Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>s
<!-- END: Header-->
<!-- BEGIN: Main Menu-->
@include('layouts.main_menu')

<!-- END: Main Menu-->
<!-- BEGIN: Content-->
<!-- END: Content-->
@yield('content')

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2020 </span><span class="float-md-right d-none d-lg-block">Made with<i class="ft-heart pink"></i> by Almotech<span id="scroll-top"></span></span></p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{URL::asset('template/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{URL::asset('template/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{URL::asset('template/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{URL::asset('template/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{URL::asset('template/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{URL::asset('template/app-assets/js/scripts/pages/ecommerce-cart.js')}}"></script>
<script src="{{URL::asset('template/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{URL::asset('template/app-assets/js/scripts/extensions/toastr.js')}}"></script>
<!-- END: Page JS-->
<script>
    @if(Illuminate\Support\Facades\Session::has('success'))
    toastr.success("{{ Illuminate\Support\Facades\Session::get('success') }}");
    @endif
    @if(Illuminate\Support\Facades\Session::has('warning'))
    toastr.warning("{{ Illuminate\Support\Facades\Session::get('warning') }}");
    @endif
    @if(Illuminate\Support\Facades\Session::has('error'))
    toastr.error("{{ Illuminate\Support\Facades\Session::get('error') }}");
    @endif
</script>

@yield('script')

</body>
<!-- END: Body-->

</html>
