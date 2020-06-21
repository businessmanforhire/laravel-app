<?php

namespace App\Http\Controllers;

use App\MobileUser;
use App\Order;
use App\BusinessInfo;
use App\BusinessSubscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if( BusinessSubscription::where('business_id',Auth::id())->where('start_date','<=',date('Y-m-d H:i:s'))->where('end_date','>=',date('Y-m-d H:i:s'))->exists()) {
           $pending_orders = Order::where('business_id', Auth::id())->pending()->get();
           $approved_orders = Order::where('business_id', Auth::id())->approved()->get();
           return view('orders.pending_orders', compact('pending_orders', 'approved_orders'));
       }
       else
        {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function order_details($id){
        $order=Order::find($id);
        return view('orders.invoice',compact('order'));

    }


    public function change_status($id,$status){

        $order=Order::findOrFail($id);
        $order->status=$status;

        $api_id = User::find($order->business_id)->business_info->api_id;
        //postal system
        if($status=='approved') {
            if ($api_id != null){
                $barcode = PostalController::barcode($api_id);
                if ($barcode == "")
                    return redirect()->back()->with('error', sprintf('No active barcodes for your orders, please contact postal system support.'));
            }
        }

        if($order->save()){

            if ($status!='approved')
            {
                $load = array('title' => 'Order Information', 'body' => 'Your order has been'.' '.$status,'id' =>1);
                $user = MobileUser::where('id', $order->mobile_user_id )->firstOrFail();
                $this->notification(array($user->active_device), $load, $user->platform);
            }

            //postal system
            if($status=='approved'){
                if ($api_id != null) {
                    PostalController::create_parcel($id, User::find($order->business_id)->business_info->api_id);

                    $load = array('title' => 'Order Information', 'body' => 'Your order has been' . ' ' . $status, 'id' => 1);
                    $user = MobileUser::where('id', $order->mobile_user_id)->firstOrFail();
                    $this->notification(array($user->active_device), $load, $user->platform);
                }

            }

            return redirect()->back()->with('success', sprintf('Status was updated successfully'));
        }else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }

    }

    public function managed_orders()
    {
        return view('orders.managed_orders');
    }

    public function order_datatable(Request $request)
    {
        $columns = array(
            0 => 'user',
            1 => 'address',
            2 => 'phone',
            3 => 'total',
            5 => 'status',
            6 => 'actions',
        );


        $auth_id=Auth::id();
        $totalData = Order::where('status','!=','pending')->where('business_id',$auth_id)->count();

        $totalFiltered = $totalData;

        if (empty($request->input('search.value'))) {
            $orders = Order::where('status','!=','pending')->where('business_id',$auth_id)->orderBy('created_at', 'desc')->get();
        } else {
            $search = $request->input('search.value');
            $mobile_user=MobileUser::where('name', 'LIKE', "%{$search}%")->orwhere('phone', 'LIKE', "%{$search}%")->first();
            $orders = Order::where('status','!=','pending')->where('mobile_user_id',$mobile_user->id)->where('business_id',$auth_id)->orderBy('created_at', 'desc')->get();

            $totalFiltered = Order::where('status','!=','pending')->where('mobile_user_id',$mobile_user->id)->where('business_id',$auth_id)->count();
        }


        $data = array();


        if (!empty($orders)) {

            foreach ($orders as $order) {
                $nestedData['user'] = $order->mobile_users->name;
                $nestedData['address'] = $order->address->city .','.$order->address->address;
                $nestedData['phone'] = $order->mobile_users->phone;
                $nestedData['total'] = $order->total;
                $nestedData['status'] = '<button  class="btn btn-sm btn-outline-primary round" >'.$order->status.'</button>';
                $nestedData['created'] = 'At: <em><b>' . date('d M Y, H:i ', strtotime($order->created_at)) . '</b></em>';
                $nestedData['actions'] = ' <a  class="btn btn-icon btn-primary btn-lighten-1 btn-sm openModal"  data-href="' . route('order_details', $order->id) . '"  ><i class="la la-eye white"></i></a>
               <div class="modal bs-modal-lg modal fade in" id="large"   tabindex="-1" role="dialog" aria-hidden="true">
                 <div class="modal-dialog modal-lg" id="modal_body">
               </div>
              </div>
                <script>
                    $(document).ready(function(){
                        $(document).on("click", ".openModal",function () {
                            path = $(this).attr("data-href");
                            $("#modal_body").load(path).fadeIn("slow");
                            $("#large").modal("toggle");
                        })
                    });
                </script>


 ';

                $data[] = $nestedData;

            }

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );


        echo json_encode($json_data);
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notification($token, $load,$platform)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $token,
            'notification' => $load,
            'priority'=>10,
        );

        $headers = array(
            'Authorization:key=AAAA2o5LQzI:APA91bFSqL7SOK1_3iRKCSFKHVYbxurX31IgDqZ_yzz8UDzaama0UgQH7rbxqAyOjFQ8t51GIS3KM3RB5F-TXVGH_dsYpP6tY_F0HGnKjimqI8gaPq5oqgG9G41DTQKKHh5zpJW4eV2g',
            'Content-Type: application/json'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // echo json_encode($fields);
        //Send the request
        $result = curl_exec($ch);

        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
        }

        curl_close($ch);
        var_dump($result);
        return $result;
    }

}
