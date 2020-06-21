@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
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
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group">
                        <button class="btn btn-sm btn-amber"  type="button" onclick="window.location='{{ route("coupon.create") }}'"><i class="ft-plus"></i> New Coupon</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Coupon Type</th>
                                                <th>Discount</th>
                                                <th>Coupon Numbers</th>
                                                <th>Code</th>
                                                <th>Availability</th>
                                                <th>Status</th>
                                                <th>Used</th>
                                                <th>Created At</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($coupons as $coupon)
                                                <tr>
                                                    <td> <img src="{{asset('storage/images/coupons/'.$coupon->image)}}" style="width:50px;height: 50px"  class="img-responsive" alt=""></td>
                                                    <td>{{$coupon->name}}</td>
                                                    <td>   <button type="button" class="btn btn-sm btn-outline-warning round">{{$coupon->coupon_type->name}}</button></td>
                                                    <td>{{$coupon->discount}}</td>
                                                    <td>{{$coupon->quantity}}</td>
                                                    <td><b>{{$coupon->code}}</b></td>
                                                    <td>{{$coupon->start_date}} - {{$coupon->end_date}}</td>
                                                    <td>

                                                        @if (date('Y-m-d H:i:s') > $coupon->start_date and  date('Y-m-d H:i:s')<$coupon->end_date)
                                                            <span class="badge badge-success lighten-1 col-md-10">Active</span>
                                                        @else

                                                            <span class="badge badge-danger lighten-1 col-md-10">Expired</span>

                                                        @endif

                                                    </td>
                                                    <td><span class="text-warning">{{$coupon->used_coupons}}</span></td>
                                                    <td><b>Created at: </b>{{date('d-M-Y H:i:s',strtotime($coupon->created_at))}}</td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

@endsection

@section('script')
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"></script>

@endsection
