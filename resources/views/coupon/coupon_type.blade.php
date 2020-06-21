@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Coupon Type</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group">
                        <button class="btn btn-sm btn-amber"  type="button" data-toggle="modal" data-target="#add_user"><i class="ft-plus"></i> New Type</button>
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
                                        <div class="modal fade text-left" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form class="form" role="form" method="POST" action="{{route('coupon_type.store')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-amber white">
                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Add Type</h4>
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
                                                                                        <input type="text" id="timesheetinput1" class="form-control" placeholder="Name" name="name" required>
                                                                                        <div class="form-control-position">
                                                                                            <i class="ft-grid"></i>
                                                                                        </div>
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
                                                    <th>Visible</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($types as $type)
                                                    <tr>
                                                        <td>{{$type->name}}</td>

                                                        <td>
                                                            @if($type->visible==\App\CouponType::visible)  <span class="badge badge-success lighten-1 col-md-10">Visible</span>
                                                            @elseif($type->visible==\App\CouponType::not_visible)  <span class="badge badge-danger lighten-1 col-md-10">Not Visible</span>
                                                            @endif
                                                        </td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($type->created_at))}}<br>
                                                            <b>Updated at:</b> {{date('d-M-Y',strtotime($type->updated_at))}}</td>

                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu arrow">
                                                                    <button class="dropdown-item" data-toggle="modal" data-target="#edit_type{{$type->id}}" > <span class="la la-wrench"></span>&nbsp;Edit</button>
                                                                    <button class="dropdown-item" data-toggle="modal"  data-target="#delete_type{{$type->id}}" type="button"><span class="la la-trash"></span>&nbsp;Delete</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <div class="modal fade text-left" id="edit_type{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('coupon_type.update',$type->id)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary bg-lighten-1 white">
                                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-edit"></i> Edit Type</h4>
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
                                                                                                        <input type="text" id="timesheetinput1" class="form-control" value="{{$type->name}}" name="name" required>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-grid"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <select  class="form-control square" name="visible" required>
                                                                                                        <option value="" disabled selected>--Visibility--</option>
                                                                                                        <option value="{{\App\CouponType::visible}}" {{$type->visible==\App\CouponType::visible ?'selected':''}} >Visible</option>
                                                                                                        <option value="{{\App\CouponType::not_visible}}" {{$type->visible==\App\CouponType::not_visible ?'selected':''}} >Not Visible</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade text-left" id="delete_type{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
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
                                                                                        <div class="card-text"> Are you sure you want to delete this type?</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                            <a href="{{route('coupon_type.delete', $type->id)}}" type="submit" class="btn btn-outline-danger">Delete</a>
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


@endsection
