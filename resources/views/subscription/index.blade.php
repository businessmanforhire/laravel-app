@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/app-assets/vendors/css/ui/prism.min.css')}}">


@endsection
@section('content')

    <!-- END: Main Menu-->
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
                                <li class="breadcrumb-item active">Subscription</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" >
                        <button class="btn btn-sm btn-amber"  type="button"  onclick="window.location='{{ route("subscription.create") }}'"><i class="ft-plus"></i> New Subscription</button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            {{--<div class="card">--}}
                                <div class="card-content collapse show">
                                    <div class="content-body">
                                        <!-- Bootstrap pricing -->
                                        <section id="social-cards-bgcolor">
                                            <div class="row">
                                                <div class="col-12 mt-3 mb-1"></div>
                                            </div>
                                            <div class="row mt-2">
                                                @foreach($subscriptions as $subscription)
                                                    <div class="col-xl-4 col-md-6 col-12">
                                                        <div class="card profile-card-with-cover">
                                                            <div class="card-content card-deck text-center">
                                                                <div class="card box-shadow">
                                                                    <div class="card-header bg-info">
                                                                        <h3 class="my-0 font-weight-bold text-white">{{$subscription->title}}
                                                                            <button type="button" class="btn btn-icon btn-amber btn-lighten-1 btn-sm pull-right" onclick="window.location='{{ route('subscription.edit',$subscription->id) }}'"  ><i class="la la-edit"></i></button>
                                                                        </h3>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <h1 class="pricing-card-title">${{$subscription->price}} <small class="text-muted">/ mo</small></h1>
                                                                        <ul class="list-unstyled mt-2 mb-2">
                                                                            {!! $subscription->description !!}
                                                                        </ul>
                                                                        <button type="button" onclick="window.location='{{ route("view_subscribers",$subscription->id) }}'" class="btn btn-lg btn-block btn-info btn-glow">View Subscribers</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            {{--</div>--}}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{URL::asset('template/app-assets/vendors/js/ui/prism.min.js')}}"></script>

@endsection
