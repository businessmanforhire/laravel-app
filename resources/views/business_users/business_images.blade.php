@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/selects/select2.min.css')}}">

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
                                <li class="breadcrumb-item"><a href="{{route('business.profile')}}">My Business Profile</a></li>
                                <li class="breadcrumb-item active">Images</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group">
                        <button class="btn btn-sm btn-amber"  type="button"  data-toggle="modal" data-target="#add_image" ><i class="ft-plus"></i> New Business Image</button>
                    </div>
                </div>
                <div class="modal fade text-left" id="add_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form class="form" role="form" method="POST" action="{{route('add_business_images')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-amber white">
                                    <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Images</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="position-relative has-icon-left">
                                                    <input type="file" id="images[]" class="form-control" multiple  required name="images[]" >
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
            <div class="content-body">
                <section id="basic-examples">
                    <div class="row match-height">
                        @forelse($images as $image)
                            <div class="col-xl-3 col-md-6 col-sm-12">
                                <div class="card match-height">
                                    <div class="card-content">
                                        <img class="card-img-top img-fluid" src="{{asset('storage/images/business/'.$image->image)}}" alt="product_image">
                                        <div class="card-body center">
                                            <a data-toggle="modal" data-target="#delete_image{{$image->id}}" class="btn btn-outline-amber">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade text-left" id="delete_image{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
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
                                                            <div class="card-text"> Are you sure you want to delete this image?</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                <a href="{{route('delete_business_image', $image->id)}}" type="submit" class="btn btn-outline-danger">Delete</a>
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



@endsection

@section('script')
    <script src="{{URL::asset('js/image_upload.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
@endsection
