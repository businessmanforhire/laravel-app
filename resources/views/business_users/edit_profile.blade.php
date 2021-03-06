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
                                <li class="breadcrumb-item active">Edit Business Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group">
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
                                        <form action="{{route('business.update.profile',$business->user_id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-clipboard"></i> Requirements</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="business_name">Company Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="business_name" class="form-control" value="{{$business->business_name}}" required name="business_name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="nuis">NUIS *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="nuis" class="form-control" value="{{$business->nuis}}" name="nuis" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="city">City *</label>
                                                    <div class="col-md-5">
                                                        <select id="city" name="city" class="select2 form-control" required>
                                                            <option value="none" selected="" disabled="">--Choose city--</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" {{$city->id==$business->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Address *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="address" class="form-control" value="{{$business->address}}" name="address" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="delivery">Delivery Price *</label>
                                                    <div class="col-md-5">
                                                        <input type="number" id="delivery" class="form-control" value="{{$business->delivery_price}}" name="delivery" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Logo *</label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                            <img @if($business->image==null) src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" @else src="{{asset('storage/images/business/'.$business->image)}}" @endif class="img-thumbnail p-0 m-0" style="" alt="user profile image" required>
                                                            <input type="file" name="image" onchange="showThumbnail(this)" />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Banner *</label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                            <img @if($business->banner==null) src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" @else src="{{asset('storage/images/business/'.$business->banner)}}" @endif
                                                                 class="img-thumbnail p-0 m-0" style="" alt="user profile image" required>
                                                            <input type="file" name="banner" onchange="showThumbnail(this)" />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Opening Hours (Weekday) *</label>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker" value="{{date('H:i',strtotime($business->open))}}"  readonly  required  name="open">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  value="{{date('H:i',strtotime($business->close))}}"  readonly required  name="close">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="address">Opening Hours (Weekend) *</label>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker" value="{{date('H:i',strtotime($business->weekend_open))}}" required   readonly  name="weekend_open">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" id="timepicker" class="form-control timepicker"  value="{{date('H:i',strtotime($business->weekend_close))}}" required  readonly  name="weekend_close">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="url">Url </label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="url" class="form-control" value="{{$business->url}}" name="url">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="desc">Description *</label>
                                                    <div class="col-md-5 ">
                                                        <textarea id="desc" rows="5" class="form-control" name="desc"  required style="resize: none">{!! $business->description !!}</textarea>
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
