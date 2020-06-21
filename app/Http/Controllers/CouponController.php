<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\CouponType;
use App\Http\Requests\CouponRequest;
use App\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( \App\BusinessSubscription::where('subscription_id',\App\Subscription::diamond)->subscription()->exists()) {
            $coupons=Coupon::where('business_id',Auth::id())->get();
            return view('coupon.index',compact('coupons'));
        }
        else{
            abort('404');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=CouponType::where('visible',CouponType::visible)->get();
        return view('coupon.add',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'discount' => 'required',
            'nr' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $file=$request->image;

        $coupon=new Coupon();
        $coupon->name=$request->name;
        $coupon->discount=$request->discount;
        $coupon->quantity=$request->nr;
        $coupon->start_date=date('Y-m-d',strtotime($request->start_date));
        $coupon->end_date=date('Y-m-d',strtotime($request->end_date));
        $coupon->code=Str::random(5);
        $coupon->business_id=Auth::id();
        $coupon->type=$request->type;
        $path='coupons';
        if($file){
            $coupon->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($coupon->save()){
            $load = array(
                'title' => 'Hi',
                'body' => 'New coupon',
                'discount_code' => $coupon->code,
                'discount_price' => $coupon->discount,
                'discount_expire' => date('Y-m-d',strtotime($coupon->end_date)),
                'image'=>$coupon->image,
                'id' =>1);

            $users_android = collect(MobileUser::where('platform','Android')->get())->unique('active_device')->pluck('active_device');
            $users_ios = collect(MobileUser::where('platform','ios')->get())->unique('active_device')->pluck('active_device');
            $this->notification_android($users_android, $load , 'Android');
            $this->notification_ios($users_ios, $load , 'ios');
            return redirect()->route('coupon.index')->with('success', sprintf('Coupon was saved successfully.'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $types=CouponType::all();
        return view('coupon.coupon_type',compact('types'));
    }

    public function store_coupon_type(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $coupon_type=new CouponType();
        $coupon_type->name=$request->name;
        $coupon_type->user_create_id = Auth::user()->id;
        $coupon_type->created_at = date("Y-m-d H:i:s");

        if($coupon_type->save()) {
            return redirect()->back()->with('success', sprintf('Coupon Type was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function  update_coupon_type(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }
        $coupon_type=CouponType::findorFail($id);
        $coupon_type->name=$request->name;
        $coupon_type->visible=$request->visible;
        $coupon_type->user_update_id = Auth::user()->id;
        $coupon_type->updated_at = date("Y-m-d H:i:s");
        if($coupon_type->save()) {
            return redirect()->back()->with('success', sprintf('Coupon Type was updated successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function delete_coupon_type($id){
        $coupon_type=CouponType::findOrFail($id);
        if($coupon_type->delete()) {
            return redirect()->back()->with('success', sprintf('Coupon Type was deleted successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public function notification_android($token, $load,$platform)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';


        $fields = array(
            'registration_ids' => $token,
            'data' => $load,
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

    public function notification_ios($token, $load,$platform)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';


        $fields = array(
            'registration_ids' => $token,
            'notification' => $load
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
        return $result;
    }
}
