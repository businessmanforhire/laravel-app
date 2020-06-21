@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/card-statistics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/card-statistics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/invoice.css')}}">
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Manage Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Justified Pills start -->
                <section id="justified-pills">
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-pills nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="active-pill" data-toggle="pill" href="#pending" aria-expanded="true">Pending <span class="badge badge badge-amber badge-pill mr-2">{{\App\Order::where('business_id',Auth::id())->pending()->count()}}</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="link-pill" data-toggle="pill" href="#approved" aria-expanded="false">Approved <span class="badge badge badge-dark badge-pill mr-2">{{\App\Order::where('business_id',Auth::id())->approved()->count()}}</span></a>
                                            </li>
                                        </ul>
                                        <br><br>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="pending" aria-labelledby="active-pill" aria-expanded="true">
                                                <section id="minimal-statistics-bg-3">
                                                    <div class="row">
                                                        @forelse($pending_orders as $order)
                                                        <div class="col-xl-3 col-md-6 col-12">
                                                            <div class="card bg-info openModal" {{--data-toggle="modal" data-target="#large{{$order->id}}"--}} data-href="{{route('order_details', $order->id)}}">
                                                                <div class="card-content">
                                                                    <div class="card-body">
                                                                        <div class="media d-flex">
                                                                            <div class="media-body text-white text-left">
                                                                                <h3 class="text-white">Order #{{$order->id}}</h3>
                                                                                <span>{{$order->mobile_users->name}}</span>
                                                                            </div>
                                                                            <div class="align-self-center">
                                                                                <i class="icon-list text-white font-large-2 float-right"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @empty
                                                            <div class="col-xl-4 col-lg-6 col-md-12"></div>
                                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                                <img class="brand-logo" alt="turbo" src="{{URL::asset('images/nodatayet.png')}}">
                                                            </div>
                                                            <div class="col-xl-4 col-lg-6 col-md-12"></div>
                                                        @endforelse
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="tab-pane" id="approved" role="tabpanel" aria-labelledby="link-pill" aria-expanded="false">

                                                <div role="tabpanel" class="tab-pane active" id="pending" aria-labelledby="active-pill" aria-expanded="true">
                                                    <section id="minimal-statistics-bg-3">
                                                        <div class="row">
                                                            @forelse($approved_orders as $order)
                                                                <div class="col-xl-3 col-md-6 col-12">
                                                                    <div class="card bg-info openModal" {{--data-toggle="modal" data-target="#large{{$order->id}}"--}} data-href="{{route('order_details', $order->id)}}">
                                                                        <div class="card-content">
                                                                            <div class="card-body">
                                                                                <div class="media d-flex">
                                                                                    <div class="media-body text-white text-left">
                                                                                        <h3 class="text-white">Order #{{$order->id}}</h3>
                                                                                        <span>{{$order->mobile_users->name}}</span>
                                                                                    </div>
                                                                                    <div class="align-self-center">
                                                                                        <i class="icon-list text-white font-large-2 float-right"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="col-xl-4 col-lg-6 col-md-12"></div>
                                                                <div class="col-xl-4 col-lg-6 col-md-12">
                                                                    <img class="brand-logo" alt="turbo" src="{{URL::asset('images/nodatayet.png')}}">
                                                                </div>
                                                                <div class="col-xl-4 col-lg-6 col-md-12"></div>
                                                            @endforelse
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div class="modal bs-modal-lg modal fade in" id="large"   tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal_body">
            <!-- modal load content -->
        </div>
    </div>
    <!-- /modal -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on("click", '.openModal',function () {
                path = $(this).attr('data-href');
                $('#modal_body').load(path).fadeIn("slow");
                $('#large').modal('toggle');
            })
        });
    </script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('template/app-assets/vendors/js/extensions/jquery.knob.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/morris.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/jquery.sparkline.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{URL::asset('template/app-assets/js/scripts/cards/card-statistics.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/pages/invoice-template.js')}}"></script>

@endsection
