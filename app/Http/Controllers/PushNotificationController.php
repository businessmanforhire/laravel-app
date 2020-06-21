<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushRequest;
use App\MobileUser;
use App\PushIndividual;
use App\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications=PushNotification::all();
        return view('push.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('push.push_global');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_individual(PushRequest $request,$id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $push = new PushIndividual();
        $push->title = $request->title;
        $push->body = $request->body;
        $push->mobile_user_id = $id;
        if ($push->save()) {
            $load = array('title' => html_entity_decode(strip_tags($request->title)), 'body' => html_entity_decode(strip_tags($request->body)),'id' =>2);
            $user = MobileUser::where('id', $id)->first();
            $this->notification(array($user->active_device), $load, $user->platform);
            return redirect()->back()->with('success', sprintf("Push Notification was sent successfully."));
        } else {
            return redirect()->back()->with('error', sprintf("An error has occurred.Please try again later"));
        }
    }



    public function store_global (PushRequest $request){
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $push = new PushNotification();
        $push->title = $request->title;
        $push->body = $request->body;
        if ($push->save()) {
            $load = array('title' => html_entity_decode(strip_tags($request->title)), 'body' => html_entity_decode(strip_tags($request->body)),'id' =>2);
            $users = MobileUser::all();
            foreach ($users as $user){
                $this->notification(array($user->active_device), $load, $user->platform);
            }
            return redirect()->back()->with('success', sprintf("Push Notification was sent successfully."));
        } else {
            return redirect()->back()->with('error', sprintf("An error has occurred.Please try again later"));
        }
    }

    public function store_individ(PushRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $push = new PushIndividual();
        $push->title = $request->title;
        $push->body = $request->body;
        $push->mobile_user_id = $request->user;
        if ($push->save()) {
            $load = array('title' => html_entity_decode(strip_tags($request->title)), 'body' => html_entity_decode(strip_tags($request->body)),'id' =>2);
            $user = MobileUser::where('id', $request->user)->first();
            $this->notification(array($user->active_device), $load, $user->platform);
            return redirect()->back()->with('success', sprintf("Push Notification was sent successfully."));
        } else {
            return redirect()->back()->with('error', sprintf("An error has occurred.Please try again later"));
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users=MobileUser::all();
        return view('push.push_individual',compact('users'));
    }


//    public function push_coupon(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|max:191',
//            'body' => 'required|max:191',
//            'coupon' => 'required',
//            'image' => 'required|image|dimensions:max_width=500,max_height=300',
//        ]);
//
//        if ($validator->fails()) {
//
//            return redirect()->back()->with('error', sprintf($validator->errors()->all()[0]));
//        }
//
//        $image='';$discount='';$expiration='';
//        $push= new PushNotification();
//        $push->title=$request->title;
//        $push->body=$request->body;
//        $push->coupon_id=$request->coupon;
//        $file = $request->image;
//
//        if($push->save()) {
//
//            $token = array();
//            $userids=array();
//
//            $image = $push->image;
//            $discount = Coupon::find($push->coupon_id)->discount;
//            $code = Coupon::find($push->coupon_id)->code;
//            $expiration = Coupon::find($push->coupon_id)->closes_at;
//            $load = array(
//                'title' => $request->title,
//                'body' => $request->body,
//                'push_image' => $image,
//                'discount_code' => $code,
//                'discount_price' => $discount,
//                'discount_expire' => date('j-m-Y', strtotime($expiration)),
//                'id' =>1);
//
//            $users_android = collect(Customer::join('customer_authentication_infos', 'customers.id', '=', 'customer_authentication_infos.customer_id')
//                ->where('customer_authentication_infos.platform','android')->get())->unique('active_device')->pluck('active_device');
//            $users_ios = collect(Customer::join('customer_authentication_infos', 'customers.id', '=', 'customer_authentication_infos.customer_id')
//                ->where('customer_authentication_infos.platform','ios')->get())->unique('active_device')->pluck('active_device');
//
//            $this->notification_android($users_android, $load , 'android');
//            $this->notification_ios($users_ios, $load , 'ios');
//
//
//            return redirect()->back()->with('success', sprintf("Push Notification was sent successfully."));
//        }
//        else
//        {
//            return redirect()->back()->with('error', sprintf("An error has occurred.Please try again later"));
//        }
//    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PushNotification $pushNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }

    public function notification($token, $load,$platform)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        if($platform=='Android') {


            $fields = array(
                'registration_ids' => $token,
                'data' => $load,
                'priority' => 10,
            );
        }
        else{
            $fields = array(
                'registration_ids' => $token,
                'notification' => $load,
                'priority' => 10,
            );
        }

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
        dump($result);
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
        dump($result);
        return $result;
    }
}
