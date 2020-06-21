@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css"href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

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
                                <li class="breadcrumb-item active">Business Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" >
                        <button class="btn btn-sm btn-amber"  type="button" onclick="window.location='{{ route("business.create") }}'"><i class="ft-plus"></i> New Business User</button>
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
                                        {{--<button class="btn btn-sm btn-primary"  type="button" onclick="window.location='{{ route("business.create") }}'"><i class="ft-plus"></i> New Business User</button>--}}
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>Business Name</th>
                                                    <th>Image</th>
                                                    <th>Category</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Created At/Updated At</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($businesses as $business)
                                                    <tr>
                                                        <td> <b>{{$business->business_name}} </b><br>
                                                            <?php $stars = number_format(\App\Review::where('business_id',$business->user_id)->avg('review'), 3, '.', ',') ; $stars = round($stars,0)?>
                                                            @for($i= 1;$i<=$stars;$i++)
                                                                @if($i>5)
                                                                    @break(0);
                                                                @endif
                                                                <i class="ft-star warning "></i>
                                                            @endfor
                                                            @if(5-$stars > 0)
                                                                @for($i= 1;$i<=5-$stars;$i++)
                                                                    <i class="ft-star"></i>
                                                                @endfor
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (file_exists(public_path('storage/images/business/'.$business->image)))
                                                                <img src="{{asset('storage/images/business/'.$business->image)}}" style="width:50px;height: 50px"  class="img-responsive" alt="">
                                                            @else
                                                                <img  alt="turbo" src="{{URL::asset('images/noimage.jpg')}}" style="width: 50px;height:50px">
                                                            @endif


                                                        </td>

                                                        {{--<td>{{\App\BusinessCategory::find($business->category_id)->name}}</td>--}}
                                                        <td>{{$business->category->name}}</td>
                                                        <td><a href = "mailto: {{$business->users->email}}">{{$business->users->email}}</a></td>
                                                        <td>
                                                            @if($business->users->status==\App\User::active_user)  <span class="badge badge-success lighten-1 col-md-10">Active</span>
                                                            @elseif($business->users->status==\App\User::inactive_user)  <span class="badge badge-danger lighten-1 col-md-10">Inactive</span>
                                                            @endif
                                                        </td>

                                                        <td> <b>Created at: </b>{{date('d-M-Y',strtotime($business->created_at))}} <br> <b>Updated at:</b> {{date('d-M-Y',strtotime($business->updated_at))}}</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu arrow">
                                                                        <button class="dropdown-item" onclick="window.location='{{ route('business.edit',$business->user_id) }}'"  > <span class="la la-wrench"></span>&nbsp;Edit</button>
                                                                        <button class="dropdown-item"  data-toggle="modal" data-target="#delete_user{{$business->user_id}}" ><span class="la la-trash"></span>&nbsp;Delete</button>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="{{route('view_business_details',$business->user_id)}}" class="dropdown-item" type="button"> <span class="ft-search"></span>&nbsp; View </a>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </td>
                                                        <div class="modal fade text-left" id="delete_user{{$business->user_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <form class="form" role="form" method="POST" action="{{route('business.delete',$business->user_id)}}">
                                                                    @csrf
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
                                                                                <a href="{{route('business.delete', $business->user_id)}}" type="submit" class="btn btn-outline-danger">Delete</a>
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
