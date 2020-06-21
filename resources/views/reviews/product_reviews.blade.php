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
                                <li class="breadcrumb-item active"> Product Reviews</li>
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
                                                    <th>Image</th>
                                                    <th>Product</th>
                                                    <th>User</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Created At</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($reviews as $review)
                                                    <tr>
                                                        <td> <img src="{{asset('storage/images/products/'.$review->product->image)}}" style="width:50px;height: 50px"  class="img-responsive" alt=""></td>
                                                        <td>{{$review->product->name}}</td>
                                                        <td>{{$review->mobile_user->name}}</td>
                                                        <td>
                                                            <?php $stars = number_format($review->review) ; $stars = round($stars,0)?>
                                                            @for($i= 1;$i<=$stars;$i++)
                                                                @if($i>5)
                                                                    @break(0);
                                                                @endif
                                                                <i class="ft-star @if($stars<3) warning  @else warning @endif"></i>
                                                            @endfor
                                                            @if(5-$stars > 0)
                                                                @for($i= 1;$i<=5-$stars;$i++)
                                                                    <i class="ft-star"></i>
                                                                @endfor
                                                            @endif

                                                        </td>
                                                        <td>{{$review->comment}}</td>
                                                        <td> <b>Created at: </b>{{date('d-M-Y H:i:s',strtotime($review->created_at))}}</td>
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
