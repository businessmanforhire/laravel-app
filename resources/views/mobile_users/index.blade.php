@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css"href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

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
                                <li class="breadcrumb-item active">Mobile Users</li>
                            </ol>
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
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Name Surname</th>
                                                    <th>Image</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Active Status</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{$user->name}}</td>
                                                        <td>
                                                            @if($user->image=='')
                                                                <img src="{{URL::asset('template/app-assets/images/portrait/small/user.png')}}"  style="width:50px;height: 50px"  class="img-responsive round">
                                                            @else
                                                                <img src="{{asset('storage/images/users/'.$user->image)}}" style="width:50px;height: 50px"  class="img-responsive round" alt="">

                                                            @endif
                                                        </td>
                                                        <td><a href = "mailto: {{$user->email}}">{{$user->email}}</a></td>
                                                        <td>{{$user->phone}}</td>
                                                        <td>
                                                            @if($user->status==\App\MobileUser::active)  <span class="badge badge-success lighten-1 col-md-6">Active</span>
                                                            @elseif($user->status==\App\MobileUser::inactive)  <span class="badge badge-danger lighten-1 col-md-6">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($user->created_at))}} <br> <b>Updated at:</b> {{date('d-M-Y',strtotime($user->updated_at))}}</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <div class="dropdown-menu arrow">
                                                                    <button class="dropdown-item" data-toggle="modal" data-target="#edit_user{{$user->id}}" > <span class="la la-wrench"></span>&nbsp;Edit User</button>
                                                                    <button class="dropdown-item"  type="button" onclick="window.location='{{ route('order_history',$user->id) }}'"><span class="ft-list"></span>&nbsp;Order History</button>
                                                                    <button class="dropdown-item" data-toggle="modal"  data-target="#send_push{{$user->id}}" type="button"><span class="ft-bell"></span>&nbsp;Send Push Notification</button>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <div class="modal fade text-left" id="edit_user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('mobile_users.update',$user->id)}}">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-primary bg-lighten-1 white">
                                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="la la-edit"></i> Edit Mobile User</h4>
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
                                                                                                        <input type="text" id="timesheetinput1" class="form-control" value="{{$user->name}}" name="name" required>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-user"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative has-icon-left">
                                                                                                        <input type="email" id="timesheetinput1" class="form-control" value="{{$user->email}}" name="email" required>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-mail"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative has-icon-left">
                                                                                                        <input type="text" id="timesheetinput1" class="form-control" value="{{$user->phone}}" name="phone" required>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-phone"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative has-icon-left">
                                                                                                        <select  class="form-control square" name="password" required>
                                                                                                            <option disabled selected value="">--Deactivate --</option>
                                                                                                            <option value="no" {{$user->status==\App\MobileUser::active ? 'selected' : ''}}>No</option>
                                                                                                            <option value="yes" {{$user->status==\App\MobileUser::inactive ? 'selected' : ''}} >Yes</option>
                                                                                                        </select>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-lock"></i>
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

                                                        <div class="modal fade text-left" id="send_push{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('push.store_individual',$user->id)}}">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-warning bg-lighten-1 white">
                                                                            <h4 class="modal-title white" id="myModalLabel9"><i class="ft-bell"></i> Send Push Notification</h4>
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
                                                                                                        <input type="text" id="timesheetinput1" class="form-control" placeholder="Title" name="title" required>
                                                                                                        <div class="form-control-position">
                                                                                                            <i class="ft-bell"></i>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="position-relative ">
                                                                                                    <textarea style="resize:none; " cols="52" rows="5" name="body" required></textarea>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-outline-warning">Save changes</button>
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
@endsection
