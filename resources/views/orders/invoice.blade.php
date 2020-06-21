<link rel="stylesheet" type="text/css" href="{{URL::asset('template/app-assets/css/pages/invoice.css')}}">
<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info bg-lighten-1 white">
                <h4 class="modal-title white" id="myModalLabel9"><i class="icon-list"></i> Order #{{$order->id}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-body">
                    <section class="card">
                        <div id="invoice-template" class="card-body p-4">
                            <!-- Invoice Company Details -->
                            <div id="invoice-company-details" class="row">
                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                    <div class="media row">
                                        <div class="col-12 col-sm-3 col-xl-2">
                                            <img src="{{URL::asset('template/app-assets/images/logo/turboo.png')}}" alt="company logo" class="mb-1 mb-sm-0" />
                                        </div>
                                        <div class="col-12 col-sm-9 col-xl-10">
                                            <div class="media-body">
                                                <ul class="ml-2 px-0 list-unstyled">
                                                    <li class="text-bold-800">Turboo</li>
                                                    <li>4025 Oak Avenue,</li>
                                                    <li>Melbourne,</li>
                                                    <li>Florida 32940,</li>
                                                    <li>USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12 text-center text-sm-right">
                                    <h2>INVOICE</h2>
                                    <p class="pb-sm-3"># INV-{{$order->id}}</p>
                                </div>
                            </div>
                            <!-- Invoice Company Details -->

                            <!-- Invoice Customer Details -->
                            <div id="invoice-customer-details" class="row pt-2">

                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                    <ul class="px-0 list-unstyled">
                                        <li class="text-bold-800"><b class="blue">Name Surname :</b> &nbsp {{$order->mobile_users->name}}</li>
                                        <li><b class="blue">City:</b> &nbsp{{$order->address->city}}</li>
                                        <li><b class="blue">Address:</b> &nbsp{{$order->address->address}}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 col-12 text-center text-sm-right">
                                    <p><span class="text-muted">Invoice Date :</span> {{date('d-m-Y',strtotime($order->created_at))}}</p>
                                </div>
                            </div>
                            <!-- Invoice Customer Details -->
                            <!-- Invoice Items Details -->
                            <div id="invoice-items-details" class="pt-2">
                                <div class="row">
                                    <div class="table-responsive col-12">
                                        <table class="table">
                                            <thead class="bg-blue text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Item </th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Price</th>
                                                <th class="text-right">Subtotal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $items=\App\OrderItem::where('order_id',$order->id)->get();
                                            @endphp
                                            @foreach($items as $item)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$item->name}}  @if($item->size!='') &nbsp <b class="blue"> ({{$item->size}}) @else @endif </b></td>
                                                    <td class="text-right">{{$item->quantity}}</td>
                                                    <td class="text-right">{{floatval($item->price)}} ALL</td>
                                                    <td class="text-right">{{$item->subtotal}} ALL</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-7 col-12 text-center text-sm-left">
                                        <p class="lead"></p>
                                        <div class="row">
                                            <div class="col-sm-8">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-12">
                                        <p class="lead">Total</p>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="text-right">{{$order->total}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kupon </td>
                                                    <td class="text-right">
                                                        @if($order->coupon=='')
                                                            - 0
                                                            @else
                                                            @if(\App\Coupon::where('code',$order->coupon)->where('business_id',$business_id)->exists())
                                                                - {{\App\Coupon::where('code',$order->coupon)->where('business_id',$business_id)->value('discount')}}
                                                                @else
                                                                - 0
                                                                @endif
                                                         @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">Total</td>
                                                    <td class="text-bold-800 text-right"> {{$order->total}} ALL</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <div class="modal-footer">
                                @if($order->status=='pending')
                                  <a href="{{route('orders.change_status', [$order->id,'approved'])}}"  class="btn btn-info btn-md my-1">Approve</a>
                                 <a href="{{route('orders.change_status', [$order->id,'refused'])}}" disabled class="btn btn-danger btn-md my-1">Refuse</a>
                                    @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

<script src="{{URL::asset('template/app-assets/js/scripts/pages/invoice-template.js')}}"></script>
