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
                    <div class="btn-group float-md-right" role="group" >
                        <button class="btn btn-sm btn-amber"  type="button" onclick="window.location='{{ route("product.create") }}'"><i class="ft-plus"></i> New Product</button>
                        <div class="modal fade text-left" id="import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form class="form" role="form" method="POST" action="{{route('product.import')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-amber white">
                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Import Products</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <a href="{{route('export_products_format')}}">Click here to download format</a>
                                                <br><br>
                                                <div class="form-body">
                                                                <div class="form-group">
                                                                    <div class="position-relative has-icon-left">
                                                                        <input type="file" id="timesheetinput1" class="form-control" placeholder="Name" name="file" required>
                                                                        <div class="form-control-position">
                                                                            <i class="ft-grid"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-amber">Save changes</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
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
                                    <div class="heading-elements">
                                        <button class="btn btn-sm btn-amber"  type="button" data-toggle="modal" data-target="#import"><i class="ft-plus"></i> Import Products</button>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        @if(\Illuminate\Support\Facades\Session::has('message'))
                                            <div class="custom-alerts alert alert-warning">{!! \Illuminate\Support\Facades\Session::get('message') !!}</div>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered server-side">
                                                <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Visible</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                {{--<tbody>--}}
                                                {{--@foreach($products as $product)--}}
                                                    {{--<tr>--}}
                                                        {{--<td>--}}
                                                             {{--@if($product->image!=null)--}}

                                                                {{--<img src="{{asset('storage/images/products/'.$product->image)}}" style="width:50px;height: 50px"  class="img-responsive" alt="">--}}

                                                            {{--@else--}}
                                                                    {{--<img  alt="turbo" src="{{URL::asset('images/noimage.jpg')}}" style="width: 50px;height:50px">--}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td>--}}
                                                          {{--<b>{{$product->name}}</b>  <br>--}}

                                                            {{--<?php $stars = number_format(\App\ProductReview::where('product_id',$product->id)->avg('review'), 3, '.', ',') ; $stars = round($stars,0)?>--}}
                                                            {{--@for($i= 1;$i<=$stars;$i++)--}}
                                                                {{--@if($i>5)--}}
                                                                    {{--@break(0);--}}
                                                                {{--@endif--}}
                                                                {{--<i class="ft-star warning "></i>--}}
                                                            {{--@endfor--}}
                                                            {{--@if(5-$stars > 0)--}}
                                                                {{--@for($i= 1;$i<=5-$stars;$i++)--}}
                                                                    {{--<i class="ft-star"></i>--}}
                                                                {{--@endfor--}}
                                                            {{--@endif--}}

                                                        {{--</td>--}}
                                                        {{--<td>{{$product->category->name}}</td>--}}
                                                        {{--<td>{{$product->price}}</td>--}}
                                                        {{--<td>{{$product->quantity}}</td>--}}
                                                        {{--<td>--}}
                                                            {{--@if($product->visible==\App\Product::visible)  <span class="badge badge-success lighten-1 col-md-10">Visible</span>--}}
                                                            {{--@elseif($product->visible==\App\Product::not_visible)  <span class="badge badge-danger lighten-1 col-md-10">Not Visible</span>--}}
                                                            {{--@endif--}}
                                                        {{--</td>--}}
                                                        {{--<td> <b>Created at: </b>{{date('d-M-Y',strtotime($product->created_at))}} <br> <b>Updated at:</b> {{date('d-M-Y',strtotime($product->updated_at))}}</td>--}}
                                                        {{--<td>--}}
                                                                {{--<div class="form-group">--}}
                                                                    {{--<button type="button" class="btn btn-icon btn-primary btn-lighten-1 btn-sm" onclick="window.location='{{ route('product.edit',$product->id) }}'"  ><i class="la la-edit"></i></button>--}}
                                                                    {{--<button type="button" class="btn btn-icon btn-warning btn-lighten-1 btn-sm" onclick="window.location='{{ route('product_images',$product->id) }}'"  ><i class="la la-image"></i></button>--}}
                                                                {{--@if($product->is_specific=='yes')--}}
                                                                {{--<button type="button" class="btn btn-icon btn-warning btn-lighten-1 btn-sm" onclick="window.location='{{ route('product_size',$product->id) }}'"  >Edit Quantity</button>--}}
                                                                 {{--@endif--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                        {{--<div class="modal fade text-left" id="delete_user{{$product->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">--}}
                                                            {{--<div class="modal-dialog" role="document">--}}
                                                                {{--<form class="form" role="form" method="POST" action="{{route('product.delete',$product->id)}}">--}}
                                                                    {{--@csrf--}}
                                                                    {{--<div class="modal-content">--}}
                                                                        {{--<div class="modal-header bg-danger bg-lighten-1 white">--}}
                                                                            {{--<h4 class="modal-title white" id="myModalLabel9"><i class="la la-trash"></i> Delete</h4>--}}
                                                                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                                                {{--<span aria-hidden="true">&times;</span>--}}
                                                                            {{--</button>--}}
                                                                        {{--</div>--}}
                                                                        {{--<div class="modal-body">--}}
                                                                            {{--<div class="col-md-12">--}}
                                                                                {{--<div class="card">--}}
                                                                                    {{--<div class="card-content collapse show">--}}
                                                                                        {{--<div class="card-body">--}}
                                                                                            {{--<div class="card-text"> Are you sure you want to delete this product?</div>--}}
                                                                                        {{--</div>--}}
                                                                                    {{--</div>--}}
                                                                                {{--</div>--}}
                                                                            {{--</div>--}}
                                                                            {{--<div class="modal-footer">--}}
                                                                                {{--<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>--}}
                                                                                {{--<a href="{{route('product.delete', $product->id)}}" type="submit" class="btn btn-outline-danger">Delete</a>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</form>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</tr>--}}
                                                {{--@endforeach--}}
                                                {{--</tbody>--}}
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
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/jszip.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"></script>


    <script>
        $('.server-side').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave":true,
            "ajax": {
                "url": "{{ route('product_datatable') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}

            },
            "columns": [
                { "data": "image" },
                { "data": "name" },
                { "data": "category" },
                { "data": "price" },
                { "data": "quantity" },
                { "data": "visible" },
                { "data": "date" },
                { "data": "actions" },
            ]

        } );

        </script>





@endsection
