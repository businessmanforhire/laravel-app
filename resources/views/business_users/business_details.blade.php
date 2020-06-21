@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/hospital-patient-profile.css')}}">
    <link rel="stylesheet" type="text/css"href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">



@endsection
@section('content')

    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Business Details</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active"> Business Details </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <section id="patient-profile">
                    <div class="row match-height">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 d-flex justify-content-around">
                                            <div class="patient-img-name text-center">
                                                <img src="{{URL::asset('images/my_profile.png')}}" alt="" class=" rounded-circle  height-150"> <br>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 d-flex justify-content-around">
                                            <div class="patient-info">
                                                <ul class="list-unstyled"><br><br>
                                                    <li> <div class="patient-info-heading">Name </div>{{\App\User::find($business->user_id)->name}}</li>
                                                    <li> <div class="patient-info-heading">Email: </div> {{\App\User::find($business->user_id)->email}} </li>
                                                    <li> <div class="patient-info-heading">Contact:</div> {{\App\User::find($business->user_id)->phone}} </li>
                                                    <li> <div class="patient-info-heading">Business :</div> {{$business->business_name}} </li>
                                                    <li> <div class="patient-info-heading">NUIS :</div> {{$business->nuis}} </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-gradient-y-info">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Category </h5>
                                </div>
                                <div class="card-content mx-2">
                                    <ul class="list-unstyled text-white patient-info-card">
                                        <li><span class="patient-info-heading">Type : </span>{{\App\BusinessCategory::find($business->business_category_id)->name}}</li>
                                    </ul>
                                </div>
                                <div class="card-header">
                                    <h5 class="card-title text-white">Address</h5>
                                </div>
                                <div class="card-content mx-2">
                                    <ul class="list-unstyled text-white patient-info-card">
                                        <li><span class="patient-info-heading">City : </span>{{\App\City::where('id',$business->city_id)->value('name')}}</li>
                                        <li><span class="patient-info-heading">Address :</span> {{$business->address}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-gradient-y-warning">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Open Hours</h5>
                                </div>
                                <div class="card-content mx-2">
                                    <ul class="list-unstyled text-white">
                                        <li>Weekday <span class="float-right">{{$business->open}} - {{$business->close}} </span></li>
                                        <li>Weekend <span class="float-right">{{$business->weekend_open}} - {{$business->weekend_close}}</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>  <img src="{{asset('storage/images/products/'.$product->image)}}" style="width:50px;height: 50px"  class="img-responsive" alt=""></td>
                                                        <td>{{$product->name}}</td>
                                                        <td>{{$product->category->name}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->quantity}}</td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($product->created_at))}} <br> <b>Updated at:</b> {{date('d-M-Y',strtotime($product->updated_at))}}</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-icon btn-primary btn-lighten-1 btn-sm" onclick="window.location='{{ route('product.edit',$product->id) }}'"  ><i class="la la-edit"></i></button>
                                                                <button type="button" class="btn btn-icon btn-danger btn-lighten-1 btn-sm" data-toggle="modal" data-target="#delete_user{{$product->id}}"  ><i class="la la-trash"></i></button>
                                                            </div>
                                                        </td>
                                                        <div class="modal fade text-left" id="delete_user{{$product->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('product.delete',$product->id)}}">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger bg-lighten-1 white">
                                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-trash"></i> Delete</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-md-12">
                                                                                <div class="card">
                                                                                    <div class="card-content collapse show">
                                                                                        <div class="card-body">
                                                                                            <div class="card-text"> Are you sure you want to delete this product?</div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                                <a href="{{route('product.delete', $product->id)}}" type="submit" class="btn btn-outline-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
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
    </div>


@endsection

@section('script')
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/leaflet/leaflet.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>


@endsection
