@extends('layouts.app')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
<!-- END: Main Menu-->
<div class="content-body">
    <!-- users edit start -->
    <section class="users-edit">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                <i class="ft-user mr-25"></i><span class="d-none d-sm-block">My Account</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                <i class="ft-lock mr-25"></i><span class="d-none d-sm-block">Change Password</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                            <!-- users edit media object start -->
                            <div class="media mb-2">
                                <a class="mr-2" href="#">
                                    <img src="{{URL::asset('template/app-assets/images/portrait/small/user.png')}}" alt="users avatar" class="users-avatar-shadow rounded-circle" height="90" width="90">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{Auth::user()->name}} {{Auth::user()->surname}} </h4>
                                    <h4 class="media-heading">{{Auth::user()->email}} </h4>
                                </div>
                            </div>
                            <!-- users edit media object ends -->
                            <!-- users edit account form start -->
                            <form role="form" action="{{route('submit_admin_edit_profile')}}" method="POST" >
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{Auth::user()->name}}" required data-validation-required-message="This username field is required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Surname</label>
                                                <input type="text" class="form-control" name="surname" placeholder="Name" value="{{Auth::user()->surname}}" required data-validation-required-message="This name field is required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{Auth::user()->email}}" required data-validation-required-message="This email field is required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Phone</label>
                                                <input type="number" class="form-control" name="phone" placeholder="Phone" value="{{Auth::user()->phone}}" required data-validation-required-message="This email field is required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save changes</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit account form ends -->
                        </div>
                        <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                            <div class="media mb-2">
                                <a class="mr-2" href="#">
                                    <img src="{{URL::asset('template/app-assets/images/portrait/small/user.png')}}" alt="users avatar" class="users-avatar-shadow rounded-circle" height="90" width="90">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{Auth::user()->name}} {{Auth::user()->surname}} </h4>
                                    <h4 class="media-heading">{{Auth::user()->email}} </h4>
                                </div>
                            </div>
                            <!-- users edit Info form start -->
                            <form role="form" action="{{route('admin_change_password')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Current Password</label>
                                                <input type="password" name="old_password" class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>New Password</label>
                                                <input type="password" name="password" class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="controls">
                                                <label>Re-type New Password</label>
                                                <input type="password" name="password_confirmation" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save changes</button>
                                    </div>
                                </div>
                            </form>
                            <!-- users edit Info form ends -->
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
