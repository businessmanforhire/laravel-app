@extends('layouts.app')

@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- eCommerce statistic -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info">{{$system_users}}</h3>
                                            <h6>System Users</h6>
                                        </div>
                                        <div>
                                            <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{$system_users}}%" aria-valuenow="{{$system_users}}" aria-valuemin="0" aria-valuemax="50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success">{{$business}}</h3>
                                            <h6>Businesses</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-follow success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$business}}%" aria-valuenow="{{$business}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="warning">{{$mobile_users}}</h3>
                                            <h6>Mobile Users</h6>
                                        </div>
                                        <div>
                                            <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: {{$mobile_users}}%" aria-valuenow="{{$mobile_users}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger">{{$products}}</h3>
                                            <h6>Products</h6>
                                        </div>
                                        <div>
                                            <i class="icon-heart danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{$products}}%" aria-valuenow="{{$products}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ eCommerce statistic -->
                <!-- Products sell and New Orders -->
                <div class="row ">
                    <div class="col-xl-9 col-12" id="ecommerceChartView">
                        <div class="card card-shadow">
                            <div class="card-header card-header-transparent py-20">
                                <div class="btn-group">
                                    <a href="#" class="text-body  blue-grey-700">Registered users /month</a>
                                </div>
                            </div>
                            <div class="widget-content tab-content bg-white p-20">
                                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay">
                                    <div style="width: 100%;margin: 0 auto;">
                                        {!! $chart->container() !!}
                                    </div>
                                    {!! $chart->script() !!}

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-12">
                                <div class="card bg-gradient-directional-primary">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{$business_categories}}</h3>
                                                    <span>Business Categories</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gradient-directional-warning">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{$categories}}</h3>
                                                    <span>Categories</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gradient-directional-amber">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{$banners}}</h3>
                                                    <span>Banners</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-cyan .bg-lighten-2">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{$business_reviewa}}</h3>
                                                    <span>Business Reviews</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           </div>
                    </div>


                <!--Recent Orders & Monthly Sales -->
                <div class="row match-height">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header card-header-transparent py-20">
                                <div class="btn-group">
                                    <a href="#" class="text-body  blue-grey-700">Approved Orders</a>
                                </div>
                            </div>
                            <div class="card-content ">
                                <div style="width: 100%;margin: 0 auto;">
                                    {!! $chart2->container() !!}
                                </div>
                                {!! $chart2->script() !!}
                            </div>
                            <div class="card-footer">
                                <div class="row mt-1">
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Pending Orders Today</h6>
                                        <h2 class="block font-weight-normal">{{$pending_orders}}</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{$pending_orders}}%" aria-valuenow="{{$pending_orders}}" aria-valuemin="0" aria-valuemax="25"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Refused Orders Today</h6>
                                        <h2 class="block font-weight-normal">{{$refused_orders}}</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{$refused_orders}}%" aria-valuenow=" {{$refused_orders}}" aria-valuemin="0" aria-valuemax="25"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Delivering Orders Today</h6>
                                        <h2 class="block font-weight-normal">{{$delivering_orders}}</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$delivering_orders}}%" aria-valuenow="{{$delivering_orders}}" aria-valuemin="0" aria-valuemax="25"></div>
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        <h6 class="text-muted">Approved Orders this Month</h6>
                                        <h2 class="block font-weight-normal">{{$approved_orders}}</h2>
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$approved_orders}}%" aria-valuenow="{{$approved_orders}}" aria-valuemin="0" aria-valuemax="25"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body sales-growth-chart">
                                    <div style="width: 100%;margin: 0 auto;">
                                        {!! $usersChart->container() !!}
                                        {!! $usersChart->script() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="chart-title mb-1 text-center">
                                    <span class="badge badge-pill bg-amber float-center"> iOS users</span>
                                    <span class="badge badge-pill bg-warning float-center"> Android users</span>
                                </div>
                                <div class="chart-stats text-center">
                                    <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1"> Mobile User Statistics <i class="ft-bar-chart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Recent Orders & Monthly Sales -->


                <div class="row match-height">
                    {{--<div class="col-xl-8 col-lg-12">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card-header card-header-transparent py-20">--}}
                                {{--<div class="btn-group">--}}
                                    {{--<a href="#" class="text-body  blue-grey-700">Approved Orders</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="card-content ">--}}
                                {{--<div style="width: 100%;margin: 0 auto;">--}}
                                    {{--{!! $chart2->container() !!}--}}
                                {{--</div>--}}
                                {{--{!! $chart2->script() !!}--}}
                            {{--</div>--}}
                            {{--<div class="card-footer">--}}
                                {{--<div class="row mt-1">--}}
                                    {{--<div class="col-3 text-center">--}}
                                        {{--<h6 class="text-muted">Pending Orders Today</h6>--}}
                                        {{--<h2 class="block font-weight-normal">{{$pending_orders}}</h2>--}}
                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                            {{--<div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: {{$pending_orders}}%" aria-valuenow="{{$pending_orders}}" aria-valuemin="0" aria-valuemax="25"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-3 text-center">--}}
                                        {{--<h6 class="text-muted">Refused Orders Today</h6>--}}
                                        {{--<h2 class="block font-weight-normal">{{$refused_orders}}</h2>--}}
                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                            {{--<div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{$refused_orders}}%" aria-valuenow=" {{$refused_orders}}" aria-valuemin="0" aria-valuemax="25"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-3 text-center">--}}
                                        {{--<h6 class="text-muted">Delivering Orders Today</h6>--}}
                                        {{--<h2 class="block font-weight-normal">{{$delivering_orders}}</h2>--}}
                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                            {{--<div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$delivering_orders}}%" aria-valuenow="{{$delivering_orders}}" aria-valuemin="0" aria-valuemax="25"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-3 text-center">--}}
                                        {{--<h6 class="text-muted">Approved Orders this Month</h6>--}}
                                        {{--<h2 class="block font-weight-normal">{{$approved_orders}}</h2>--}}
                                        {{--<div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
                                            {{--<div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{$approved_orders}}%" aria-valuenow="{{$approved_orders}}" aria-valuemin="0" aria-valuemax="25"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="col-xl-5 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Latest Reviews</h4>
                                <a class="heading-elements-toggle"><i class="la la-star font-medium-3"></i></a>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">Business</th>
                                            <th class="border-top-0">Client</th>
                                            <th class="border-top-0">Rates</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($latest_reviews as $review)
                                            <tr>
                                                <td class="text-truncate">
                                                    {{\App\BusinessInfo::where('user_id',$review->business_id)->value('business_name')}}
                                                </td>
                                                <td class="text-truncate">{{$review->mobile_user->name}}</td>
                                                <td>

                                                        <?php $stars = number_format($review->review, 3, '.', ',') ; $stars = round($stars,0)?>
                                                        @for($i= 1;$i<=$stars;$i++)
                                                            @if($i>5)
                                                                @break(0);
                                                            @endif
                                                            <i class="ft-star warning "></i>
                                                        @endfor
                                                        @if(5-$stars > 0)
                                                            @for($i= 1;$i<=5-$stars;$i++)
                                                                <i class="ft-star"></i>
                                                            @endfor
                                                        @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                <div class="col-xl-3 col-lg-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body sales-growth-chart">
                                    <div style="width: 100%;margin: 0 auto;">
                                        {!! $ageChart->container() !!}
                                        {!! $ageChart->script() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="chart-title mb-1 text-center">
                                    <span class="badge badge-pill bg-amber float-center"> 18-25</span>
                                    <span class="badge badge-pill bg-warning float-center"> 26-45</span>
                                    <span class="badge badge-pill bg-primary float-center"> > 45</span>
                                </div>
                                <div class="chart-stats text-center">
                                    <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1"> Age User Statistics <i class="ft-bar-chart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

