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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('mobile_users.index')}}">Mobile Users</a></li>
                                <li class="breadcrumb-item active">Order History</li>
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
                                        <div class="tab-content px-1 pt-1">
                                                <section id="minimal-statistics-bg-3">
                                                    <div class="row">
                                                        @forelse($orders as $order)
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
