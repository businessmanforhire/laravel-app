@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/selects/select2.min.css')}}">

    <script>
        $( document ).ready(function()
        {
            var is_offer = document.getElementById('offer').value;

            if (is_offer == '1') {
                document.getElementById('oferta').innerHTML = '<div class="form-group row">\n' +
                    '                                                    <label class="col-md-3 label-control"> Discount</label>\n' +
                    '                                                    <div class="col-md-5">\n' +
                    '                                                            <input type="number" min="1" max="100" class="form-control" name="discount" value="{{$product->discount}}" >\n' +
                    '                                                    </div>\n' +
                    '                                                </div>';}
            else {
                document.getElementById('oferta').innerHTML = '';
            }
        });
    </script>

    <script>
        $( document ).ready(function() {
            $("#specification").change(function(){
                var value = $(this).val();
                if (value=='yes')
                {
                    $("#specific_quantity").show();
                    $("#general_quantity").hide();
                }
                else if (value=='no')
                {
                    $("#general_quantity").show();
                    $("#specific_quantity").hide();
                }
            }).change();
        });
    </script>


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
                                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                                <li class="breadcrumb-item active">Edit Product</li>
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
                                    <h4 class="card-title" id="horz-layout-basic">Product Info</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements"></div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text"></div>
                                        <form action="{{route('product.update',$product->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name"> Name *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="name" class="form-control" value="{{$product->name}}" required name="name">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name"> Is Offer *</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control m-input" name="is_offer" onChange="myFunction()" id="offer" required>
                                                            <option value="" selected disabled>--Zgjidhni--</option>
                                                            @if($product->is_offer===\App\Product::is_offer)
                                                                <option value="1" selected>Po</option>
                                                                <option value="0">Jo</option>
                                                            @elseif($product->is_offer===\App\Product::not_offer)
                                                                <option value="1" >Po</option>
                                                                <option value="0" selected>Jo</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>


                                                <div id="oferta"></div>
                                                <script>

                                                    function myFunction() {
                                                        var is_offer=document.getElementById('offer').value;
                                                        if(is_offer=='1')
                                                        {
                                                            document.getElementById('oferta').innerHTML='<div class="form-group row">\n' +
                                                                '                                                    <label class="col-md-3 label-control">Discount</label>\n' +
                                                                '                                                    <div class="col-md-5">\n' +
                                                                '                                                            <input type="number" min="1" max="100" class="form-control" name="discount" value="{{$product->discount}}" >\n' +
                                                                '                                                    </div>\n' +
                                                                '                                                </div>';
                                                        }
                                                        else {document.getElementById('oferta').innerHTML='';}
                                                    }

                                                </script>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="name"> Is Specific *</label>
                                                    <div class="col-md-5">
                                                        <select class="form-control m-input" name="specification" id="specification"   required>
                                                            <option value="" selected disabled>--Zgjidhni--</option>
                                                            @if($product->is_specific=='no')
                                                                <option value="yes">Yes</option>
                                                                <option value="no" selected>No</option>
                                                            @elseif($product->is_specific=='yes')
                                                                <option value="yes" selected>Yes</option>
                                                                <option value="no" >No</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Image *</label>
                                                    <div class="col-md-5 ">
                                                        <div class="upload-btn-img">
                                                                <img src="{{asset('storage/images/products/'.$product->image)}}"
                                                                     class="img-thumbnail p-0 m-0" style="" alt="user profile image">
                                                                <input type="file" name="image" onchange="showThumbnail(this)" />
                                                        </div>
                                                        <span class="file-custom"></span>
                                                    </div>
                                                </div>
                                                <div class="general_quantity" id="general_quantity" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                                        <div class="col-md-5">
                                                            <input type="text" id="quantity" class="form-control" value="{{$product->quantity}}" name="quantity">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="specific_quantity" id="specific_quantity" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="quantity">Quantity *</label>
                                                        <div class="col-md-5">
                                                            @foreach($product->product_size as $item)
                                                                <div class="row">
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <input class="form-control" value="{{$item->size}}" name="size" id="size" disabled>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <div class="form-group">
                                                                                    <input  class="form-control"  type="text" name="quantity" id="quantity" value="{{$item->quantity}}" disabled>
                                                                                </div>
                                                                            </div>
                                                                </div>
                                                                @endforeach
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="price">Price *</label>
                                                    <div class="col-md-5">
                                                        <input type="text" id="price" class="form-control" value="{{$product->price}}" name="price">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="category">Category *</label>
                                                    <div class="col-md-5">
                                                        <select id="category" name="category" class="select2 form-control">
                                                            <option value="none" selected="" disabled="">--Choose category--</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}" {{$category->id==$product->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="brand">Brand </label>
                                                <div class="col-md-5">
                                                    <select id="brand" name="brand" class="select2 form-control">
                                                        <option value="none" selected="" disabled="">--Choose brand--</option>
                                                        @foreach($brands as $brand)
                                                            <option value="{{$brand->id}}" {{$brand->id==$product->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="desc">Description</label>
                                                    <div class="col-md-5 ">
                                                        <textarea id="desc" rows="5" class="form-control" name="desc"  style="resize: none">{!! $product->description !!}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control" for="phone">Visible *</label>
                                                    <div class="col-md-5">
                                                        <select  class="form-control square" name="visible" required>
                                                            <option value="" disabled selected>--Status--</option>
                                                            <option value="{{\App\Product::visible}}" {{$product->visible==\App\Product::visible ?'selected':''}} >Visible</option>
                                                            <option value="{{\App\Product::not_visible}}" {{$product->visible==\App\Product::not_visible ?'selected':''}} >Not Visible</option>
                                                        </select>
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
@endsection
