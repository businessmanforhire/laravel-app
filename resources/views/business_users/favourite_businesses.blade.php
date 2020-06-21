@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/image_upload.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/forms/selects/select2.min.css')}}">



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
                                <li class="breadcrumb-item active">Favourite Businesses</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" >
                        <button class="btn btn-sm btn-amber"  type="button" data-toggle="modal" data-target="#add"><i class="ft-plus"></i> Add Business</button>
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
                                        <!-- Modal -->
                                        <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form class="form" role="form" method="POST" action="{{route('add_highlighted_businesses')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-amber white">
                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Add Business</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-content collapse show">
                                                                        <div class="card-body">
                                                                            <div class="card-text">
                                                                            </div>
                                                                            <div class="form-body">
                                                                                <div class="form-group">
                                                                                    <div class="position-relative has-icon-left">
                                                                                        <select id="business" name="business" class="select2 form-control" required>
                                                                                            <option value="" selected="" disabled="">--Choose business--</option>
                                                                                            @foreach($business_infos as $business)
                                                                                                <option value="{{$business->user_id}}">{{$business->business_name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
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
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Name </th>
                                                    <th>Image</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($businesses as $business)
                                                    <tr>
                                                        <td>{{\App\BusinessInfo::where('user_id',$business->business_id)->value('business_name')}}</td>
                                                        <td>
                                                            @if (file_exists(public_path('storage/images/category/'.\App\BusinessInfo::where('user_id',$business->business_id)->value('business_name'))))
                                                                <img src="{{asset('storage/images/category/'.\App\BusinessInfo::where('user_id',$business->business_id)->value('business_name'))}}" style="width:50px;height: 50px"  class="img-responsive" alt="">
                                                            @elseif($business->image==null)
                                                                <img  alt="turbo" src="{{URL::asset('images/noimage.jpg')}}" style="width: 50px;height:50px">
                                                            @else
                                                                <img  alt="turbo" src="{{URL::asset('images/noimage.jpg')}}" style="width: 50px;height:50px">
                                                            @endif
                                                        </td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($business->created_at))}}<br>
                                                            <b>Updated at:</b> {{date('d-M-Y',strtotime($business->updated_at))}}</td>

                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-icon btn-danger btn-lighten-1 btn-sm" data-toggle="modal" data-target="#delete{{$business->id}}" ><i class="la la-trash"></i></button>
                                                            </div>
                                                        </td>

                                                        <div class="modal fade text-left" id="delete{{$business->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                                                        <div class="card-text"> Are you sure you want to delete this business?</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                            <a href="{{route('delete_highlighted_businesses', $business->id)}}" type="submit" class="btn btn-outline-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
    <script src="{{URL::asset('js/image_upload.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>



@endsection
