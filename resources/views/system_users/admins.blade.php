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
                            <li class="breadcrumb-item active">System Users</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" a>
                    <button class="btn btn-sm btn-amber"  type="button" data-toggle="modal" data-target="#add_user"><i class="ft-plus"></i> New User</button>
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
                                           <form class="form" role="form" method="POST" action="{{route('admin.store')}}">
                                               @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header bg-amber white">
                                                        <h4 class="modal-title white" id="myModalLabel9"><i class="la la-plus"></i> Add User</h4>
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
                                                                                    <i class="ft-user"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="text" id="timesheetinput1" class="form-control" placeholder="Surname" name="surname" required>
                                                                                <div class="form-control-position">
                                                                                    <i class="ft-user"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="email" id="timesheetinput1" class="form-control" placeholder="Email" name="email" required>
                                                                                <div class="form-control-position">
                                                                                    <i class="ft-mail"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="position-relative has-icon-left">
                                                                                <input type="text" id="timesheetinput1" class="form-control" placeholder="Phone" name="phone" required>
                                                                                <div class="form-control-position">
                                                                                    <i class="ft-phone"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="position-relative has-icon-left">
                                                                            <select  class="form-control square" name="role" required>
                                                                                <option value="" selected disabled >--Role--</option>
                                                                                <option value="{{\App\User::admin}}">Admin</option>
                                                                                <option value="{{\App\User::manager}}">Manaxher</option>
                                                                                <option value="{{\App\User::operator}}">Operator</option>
                                                                            </select>
                                                                                <div class="form-control-position">
                                                                                    <i class="ft-user"></i>
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
                                                <th>Name Surname</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Created At/Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($admins as $admin)
                                            <tr>
                                                <td>{{$admin->full_name}}</td>
                                                <td><a href = "mailto: {{$admin->email}}">{{$admin->email}}</a></td>
                                                <td>{{$admin->phone}}</td>
                                                <td>
                                                    @if($admin->role==\App\User::admin)<span class="badge badge-success col-md-10">Admin</span>
                                                    @elseif($admin->role==\App\User::operator)<span class="badge badge-warning col-md-10">Operator</span>
                                                    @else($admin->role==\App\User::manager)<span class="badge badge-primary col-md-10">Manager</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($admin->status==\App\User::active_user)  <span class="badge badge-success lighten-1 col-md-10">Active</span>
                                                    @elseif($admin->status==\App\User::inactive_user)  <span class="badge badge-danger lighten-1 col-md-10">Inactive</span>
                                                    @endif
                                                </td>
                                                <td> <b>Created at: </b>{{date('d-M-Y',strtotime($admin->created_at))}} <br> <b>Updated at:</b> {{date('d-M-Y',strtotime($admin->updated_at))}}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-icon btn-primary btn-lighten-1 btn-sm" data-toggle="modal" data-target="#edit_user{{$admin->id}}"><i class="la la-edit"></i></button>
                                                    </div>
                                                </td>
                                                <div class="modal fade text-left" id="edit_user{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form class="form" role="form" method="POST" action="{{route('admin.update',$admin->id)}}">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary bg-lighten-1 white">
                                                                    <h4 class="modal-title white" id="myModalLabel9"><i class="la la-edit"></i> Edit User</h4>
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
                                                                                            <input type="text" id="timesheetinput1" class="form-control" value="{{$admin->name}}" name="name" required>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-user"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                            <input type="text" id="timesheetinput1" class="form-control" value="{{$admin->surname}}" name="surname" required>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-user"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                            <input type="email" id="timesheetinput1" class="form-control" value="{{$admin->email}}" name="email" required>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-mail"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                            <input type="text" id="timesheetinput1" class="form-control" value="{{$admin->phone}}" name="phone" required>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-phone"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                        <select  class="form-control square" name="role" required>
                                                                                            <option disabled selected>--Role--</option>
                                                                                            <option value="{{\App\User::admin}}" {{$admin->role==\App\User::admin ?'selected':''}} >Admin</option>
                                                                                            <option value="{{\App\User::manager}}" {{$admin->role==\App\User::manager ?'selected':''}}>Manaxher</option>
                                                                                            <option value="{{\App\User::operator}}" {{$admin->role==\App\User::operator ?'selected':''}}>Operator</option>
                                                                                        </select>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-user"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                            <select  class="form-control square" name="password" required>
                                                                                                <option disabled selected value="">--Reset Password --</option>
                                                                                                <option value="yes">Yes (turbo1234)</option>
                                                                                                <option value="no">No</option>
                                                                                            </select>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-lock"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                        <div class="position-relative has-icon-left">
                                                                                            <select  class="form-control square" name="status" required>
                                                                                                <option value="" disabled selected>--Status--</option>
                                                                                                <option value="{{\App\User::active_user}}" {{$admin->status==\App\User::active_user ?'selected':''}} >Active</option>
                                                                                                <option value="{{\App\User::inactive_user}}" {{$admin->status==\App\User::inactive_user ?'selected':''}} >Inactive</option>
                                                                                            </select>
                                                                                            <div class="form-control-position">
                                                                                                <i class="ft-user"></i>
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


@endsection
