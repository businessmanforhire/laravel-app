@extends('layouts.app')

@section('header')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/plugins/pickers/daterange/daterange.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/image_upload.css')}}">



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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('coupon.index')}}">Coupons</a></li>
                                <li class="breadcrumb-item active">Add Coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" >
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
                                    <h4 class="card-title" id="horz-layout-basic">Coupon Info</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text"></div>
                                        <form action="{{route('coupon.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="name" class="form-control" placeholder="First Name" required name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="price">Discount *</label>
                                                    <div class="col-md-5">
                                                        <input type="number" id="price" class="form-control" placeholder="Discount" name="discount" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="price">Coupon Numbers *</label>
                                                    <div class="col-md-5">
                                                        <input type="number" id="price" class="form-control" placeholder="Coupon Numbers to use" min="1"  name="nr" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="category">Type *</label>
                                                    <div class="col-md-5">
                                                        <select id="category" name="type" class="select2 form-control">
                                                            <option value="none" selected="" disabled="">--Choose type--</option>
                                                            @foreach($types as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Image *</label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                            <img src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"
                                                                 class="img-thumbnail p-0 m-0" style="" alt="user profile image">
                                                            <input type="file" name="image" onchange="showThumbnail(this)" />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="desc">Start Date</label>
                                                    <div class="col-md-5 ">
                                                        <div class='input-group'>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="la la-calendar-o"></span>
                                                        </span>
                                                                </div>
                                                                <input type='text' class="form-control pickadate datepicker" placeholder="Basic Pick-a-start-date" name="start_date" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="desc">End Date</label>
                                                    <div class="col-md-5 ">
                                                        <div class='input-group'>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="la la-calendar-o"></span>
                                                        </span>
                                                                </div>
                                                                <input type='text' class="form-control pickadate datepicker" placeholder="Basic Pick-an-end-date" name="end_date" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1 la la-check-square-o">Save</button>
                                            </div>
                                        </form>
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
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>
    <script src="{{URL::asset('js/image_upload.js')}}"></script>

@endsection
