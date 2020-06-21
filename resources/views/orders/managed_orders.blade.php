@extends('layouts.app')

@section('header')
    <link rel="stylesheet" type="text/css"href="{{URL::asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">


    <link rel="stylesheet" type="text/css" href="{{asset('template/app-assets/css/plugins/pickers/daterange/daterange.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('template/app-assets/vendors/css/forms/selects/select2.min.css')}}">



    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/card-statistics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/card-statistics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/invoice.css')}}">


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
                                <li class="breadcrumb-item active">Managed Orders</li>
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
                                    <div class="heading-elements">
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                                    <table class="table table-striped table-bordered server-side ">
                                                        <thead>
                                                        <tr>
                                                            <th>User</th>
                                                            <th>Address </th>
                                                            <th>Phone</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <th>User</th>
                                                            <th>Address </th>
                                                            <th>Phone</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </tfoot>
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

    <!-- modal -->
    <div class="modal bs-modal-lg modal fade in" id="large"   tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="modal_body">
            <!-- modal load content -->
        </div>
    </div>
    <!-- /modal -->

    <script>
        $(document).ready(function(){
            $(document).on("click", '.openModal',function () {
                path = $(this).attr('data-href');
                $('#modal_body').load(path).fadeIn("slow");
                $('#large').modal('toggle');
            })
        });
    </script>

@endsection

@section('script')



    <script src="{{URL::asset('template/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('template/app-assets/vendors/js/extensions/jquery.knob.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/morris.min.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/vendors/js/charts/jquery.sparkline.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <script src="{{URL::asset('template/app-assets/js/scripts/cards/card-statistics.js')}}"></script>
    <script src="{{URL::asset('template/app-assets/js/scripts/pages/invoice-template.js')}}"></script>

    <script>

        // $(document).ready(function() {
        //     $('.pickadate1').pickadate();
        //     $('.pickadate2').pickadate();
        // } );
        //


        $('.server-side').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave":true,
            "ajax": {
                "url": "{{ route('order_datatable') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}

            },
            "columns": [
                { "data": "user" },
                { "data": "address" },
                { "data": "phone" },
                { "data": "total" },
                { "data": "status" },
                { "data": "actions" },
            ]

        } );


        {{--function filter() {--}}

            {{--var status=$('#status').val();--}}
            {{--var start_date=$('#start_date').val();--}}
            {{--var end_date=$('#end_date').val();--}}
            {{--var holder=$('#holder').val();--}}

            {{--$('.server-side').DataTable( {--}}
                {{--"processing": true,--}}
                {{--"serverSide": true,--}}
                {{--"stateSave":true,--}}
                {{--"destroy":true,--}}
                {{--"ajax": {--}}
                    {{--"url": "{{ route('orders_datatable_search') }}",--}}
                    {{--"dataType": "json",--}}
                    {{--"type": "POST",--}}
                    {{--"data":{ _token: "{{csrf_token()}}",--}}
                        {{--status:status,--}}
                        {{--start_date:start_date,--}}
                        {{--end_date:end_date,--}}
                        {{--holder:holder,--}}
                    {{--}--}}

                {{--},--}}
                {{--"columns": [--}}
                    {{--{ "data": "client" },--}}
                    {{--{ "data": "address" },--}}
                    {{--{ "data": "phone" },--}}
                    {{--{ "data": "price_total" },--}}
                    {{--{ "data": "delivery_date" },--}}
                    {{--{ "data": "status" },--}}
                    {{--{ "data": "created" },--}}
                    {{--{ "data": "actions" },--}}

                {{--]--}}

            {{--} );--}}


        {{--}--}}
    </script>
@endsection
