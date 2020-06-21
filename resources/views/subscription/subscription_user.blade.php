@extends('layouts.app')

@section('header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('subscription.index')}}">Subscriptions</a></li>
                                <li class="breadcrumb-item active">Subscribers</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" >
                        <button class="btn btn-sm btn-amber"  type="button" data-toggle="modal" data-target="#add_brand"><i class="ft-plus"></i> Add new Subscriber</button>
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
                                        <div class="modal fade text-left" id="add_brand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel9" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form class="form" role="form" method="POST" action="{{route('add_subscriber',$sub_id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-amber white">
                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Add Subscription</h4>
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
                                                                                            @foreach($businesses as $business)
                                                                                                <option value="{{$business->user_id}}">{{$business->business_name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="position-relative has-icon-left">
                                                                                        <select id="month" name="month" class="select2 form-control" required>
                                                                                            <option value="" selected="" disabled="" >--Choose month--</option>
                                                                                            @foreach($months as $month)
                                                                                                <option value="{{$month->id}}">{{$month->number}} Months</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="position-relative has-icon-left">
                                                                                        <input type="text" id="timesheetinput1" class="form-control" placeholder="Comment" name="comment" >
                                                                                        <div class="form-control-position">
                                                                                            <i class="ft-comment"></i>
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
                                                    <th>Business </th>
                                                    <th>Month</th>
                                                    <th>Start Date/ Expires</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($subscriptions as $subsription)
                                                    <tr>
                                                        <td>{{\App\BusinessInfo::where('user_id',$subsription->business_id)->value('business_name')}}</td>
                                                        <td>{{\App\SubscriptionTime::find($subsription->month_id)->number}} months</td>
                                                        <td>
                                                            <b>Start Date: </b>{{date('d-m-y  H:i:s',strtotime($subsription->start_date))}}
                                                            <br>
                                                            <b>Expires: </b>{{date('d-m-y  H:i:s',strtotime($subsription->end_date))}}</td>
                                                        <td>

                                                            @if (date('Y-m-d H:i:s') >= $subsription->start_date and  date('Y-m-d H:i:s')<$subsription->end_date)
                                                                <span class="badge badge-success lighten-1 col-md-10">Active</span>
                                                                @else

                                                                <span class="badge badge-danger lighten-1 col-md-10">Expired</span>

                                                            @endif

                                                        </td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($subsription->created_at))}}<br>
                                                            <b>By:</b> {{\App\User::find($subsription->user_create_id)->name}}
                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-icon btn-primary btn-lighten-1 btn-sm" data-toggle="modal" data-target="#edit_subscription{{$subsription->id}}"><i class="la la-edit"></i></button>
                                                            </div>
                                                        </td>
                                                        <div class="modal fade text-left" id="edit_subscription{{$subsription->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('update_subscriber',[$sub_id,$subsription->id])}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary bg-lighten-1 white">
                                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-edit"></i> Edit Category</h4>
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
                                                                                                            @foreach($businesses as $business)
                                                                                                                <option value="{{$business->user_id}}" {{$business->user_id==$subsription->business_id ? 'selected' : ''}}>{{$business->business_name}}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative has-icon-left">
                                                                                                        <select id="month" name="month" class="select2 form-control" required>
                                                                                                            <option value="" selected="" disabled="" >--Choose month--</option>
                                                                                                            @foreach($months as $month)
                                                                                                                <option value="{{$month->id}}" {{$month->id==$subsription->month_id ? 'selected' : ''}}>{{$month->number}} Months</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative has-icon-left">
                                                                                                        <input type="text" id="timesheetinput1" class="form-control" value="{{$subsription->comment}}" name="comment" >
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-comment"></i>
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
                                                                                <button type="submit" class="btn btn-outline-primary">Save changes</button>
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
    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>



@endsection
