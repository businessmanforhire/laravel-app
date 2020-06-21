@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">


@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/image_upload.css')}}">


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
                                <li class="breadcrumb-item"><a href="{{route('business.index')}}">Business Users</a></li>
                                <li class="breadcrumb-item active">Add Business Users</li>
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
                                    <h4 class="card-title" id="horz-layout-basic">Business Info</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text"></div>
                                        <form action="{{route('business.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>

                                               {{-- postal system--}}

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">Postal system Id </label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="id" class="form-control" placeholder="Id"  name="api_id">
                                                    </div>
                                                </div>

                                                {{-- postal system--}}

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name">First Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="name" class="form-control" placeholder="First Name" required name="name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="surname">Last Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="surname" class="form-control" placeholder="Last Name" name="surname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="email">E-mail *</label>
                                                    <div class="col-md-5">
                                                        <input type="email" id="email" class="form-control" placeholder="E-mail" name="email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="phone">Contact Number *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="phone" class="form-control" placeholder="Phone" name="phone">
                                                    </div>
                                                </div>
                                                <h4 class="form-section"><i class="ft-clipboard"></i> Requirements</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="business_name">Company Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="business_name" class="form-control" placeholder="Company Name" name="business_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="category">Category *</label>
                                                    <div class="col-md-5">
                                                        <select id="category" name="category" class="select2 form-control" required>
                                                            <option value="" selected="" disabled="">--Choose--</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Logo </label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                            <img src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"
                                                                 class="img-thumbnail p-0 m-0" style="" alt="user profile image">
                                                            <input type="file" name="image" onchange="showThumbnail(this)"  />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Banner </label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                            <img src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"
                                                                 class="img-thumbnail p-0 m-0" style="" alt="user profile image">
                                                            <input type="file" name="banner" onchange="showThumbnail(this)"  />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="nuis">NUIS </label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="nuis" class="form-control" placeholder="NUIS" name="nuis">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="city">City </label>
                                                    <div class="col-md-5">
                                                        <select id="city" name="city" class="select2 form-control" >
                                                            <option value="" selected="" disabled="">--Choose city--</option>
                                                            @foreach($cities as $city)
                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Address </label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="address" class="form-control" placeholder="Address" name="address">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Opening Hours (Weekday) </label>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  readonly   name="open">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  readonly   name="close">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Opening Hours (Weekend) </label>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  readonly  name="weekend_open">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  readonly  name="weekend_close">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="url">Url </label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="url" class="form-control" placeholder="Url" name="url">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="desc">Description</label>
                                                    <div class="col-md-5 ">
                                                        <textarea id="desc" rows="5" class="form-control" name="desc" placeholder="Description" style="resize: none"></textarea>
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
    <script src="{{URL::asset('js/image_upload.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input.timepicker').timepicker({});
        });
    </script>


@endsection
