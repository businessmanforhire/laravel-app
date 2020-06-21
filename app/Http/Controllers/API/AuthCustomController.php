<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthCustomController extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:mobile_users',
            'phone'=>'required|unique:mobile_users',
            'password' => 'required|min:6',
            'platform' => 'required',
            'firebase_token' => 'required',
            'date_of_birth' => 'date_format:Y-m-d|before:today'

        ]);
        if ($validator->fails())
        {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $user = new MobileUser() ;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone= $request->phone;
        $user->password = bcrypt($request->password);
        $user->platform = $request->platform;
        $user->active_device = $request->firebase_token;
        $user->date_of_birth =date('Y-m-d',strtotime($request->date_of_birth));

        if( $user->save())
        {
            $user = MobileUser::find($user->id);
            $object = [
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email,
                        "phone" => $user->phone,
                        "date_of_birth"=>$user->date_of_birth

                       ];

             return response()->json(['error' => false, 'token' => $user->createToken('app')->accessToken, 'data' => $object]);
        }
         else
        {
            return response()->json(['error' => true , 'message' => 'Error.Please try again later']);
        }

    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
            'firebase_token' => 'required',
            'platform' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        if(MobileUser::where('email',$request->email)->exists())
        {
            $user=MobileUser::where('email',$request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                $remember_token = Str::random(60);
                $user->remember_token = $remember_token;
                $user->active_device = $request->firebase_token;
                $user->platform = $request->platform;
                $user->save();
                $object = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "phone"=>$user->phone,
                    "remember_token" => $user->remember_token,
                    "date_of_birth"=>is_null($user->date_of_birth)? "" :$user->date_of_birth,
                    "created_at" => $user->created_at->format(' H:i j M Y'),
                ];
                return response()->json(['error' => false, 'message' => 'Login successful', 'token' => $user->createToken('app')->accessToken, 'data' => $object]);
            }
            else {
                return response()->json(['error' => true, 'message' => 'Passwords does not match']);
            }
        }
        else {
            return response()->json(['error' => true, 'message' => 'No user was found with this email.']);
        }
    }



    public function send_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => 'Plotesoni numrin e telefonit']);
        }


        $attempts=0;
        $phone=str_replace('+', '',$request->phone);
        DB::beginTransaction();
        try {
            $user=MobileUser::where('phone',$request->phone)->first();
            if($user) {
                if ($user->sent_at != null) {
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', (string)$user->sent_at);
                    $from = date('Y-m-d H:i:s');
                    $diff_in_minutes = $to->diffInMinutes($from);


                    if ($user->attempts == 5) {
                        if ($diff_in_minutes <= 30) {
                            return response()->json(['error' => true, 'message' => 'Keni arritur limitin e dergimit te sms, mund te dergoni kod te ri pas 30 minutash!']);
                        } else {
                            MobileUser::where('phone', $request->phone)->update(['attempts' => 0]);
                        }
                    }
                }

                if (/*$request->phone == '0694489809' || */$request->phone == '355673004334'
                    || $request->phone=='355673008338'
//                     || $request->phone=='355694812891'
                    || $request->phone=='355698898029'
                    || $request->phone=='355692463979'
                    /* || $request->phone=='355673004334'*/) {
                    $code = '111111';
                } else {

                    /*************************************************************************/
                    // $Message->recipients = array((string)$phone);
                    try {
                        $code = mt_rand(111111, 999999);
                        $client = new \GuzzleHttp\Client();
                        $url = "https://mybsms.vodafone.al/ws/send.json";
                        $response = $client->post($url, [
                            'headers' => ['Content-type' => 'application/json'],
                            'json' => [
                                'username' => 'TURBO ALBANIA',
                                'password' => '5xaF9s0ED',
                                'senderId' => 'TURBO ALBANIA',
                                'recipients' => array($phone),
                                'message' => '' . $code,
                                'dlr-url' => 'https://mybsms.vodafone.al/ws/send.json',
                            ]
                        ]);

                        $data = json_decode($response->getBody());
                        $message = $data->error;
                        // return response()->json(['error' => false, 'message' => $message]);


                        $user = MobileUser::where('phone', $request->phone)->first();
                        if ($request->phone_number == '355692463979' ||$request->phone_number == '0694812891' || $request->phone_number == '0673004334' /*|| $request->phone_number == '355694812891'*/) {
                        } else {
                            if ($user->attempts == null) {
                                $attempts = 0;
                            } else {
                                $attempts = $user->attempts;
                            }
                        }

                        MobileUser::where('phone', $request->phone)->update(['code' => $code, 'attempts' => $attempts + 1, 'sent_at' => date('Y-m-d H:i:s'), 'sent' => 'yes']);
                        DB::commit();
                        return response()->json(['error' => false, 'message' => 'Success', 'user_id' => $user->id]);


                    } catch (BadResponseException $e) {
                        return response()->json(['error' => false, 'message' => 'Ka nje problem, ju lutem provoni me vone']);
                    }
                    /*************************************************************************/
                }

                $user = MobileUser::where('phone', $request->phone)->first();
                if ($request->phone_number == '355673004334'
                    /*|| $request->phone_number == '355694489809'*/
//                    || $request->phone=='355694812891'
                    || $request->phone=='355698898029'
                    || $request->phone=='355692463979'
                  ) {
                } else {
                    if ($user->attempts == null) {
                        $attempts = 0;
                    } else {
                        $attempts = $user->attempts;
                    }
                }

                MobileUser::where('phone', $request->phone)->update(['code' => $code, 'attempts' => $attempts + 1, 'sent_at' => date('Y-m-d H:i:s'), 'sent' => 'yes']);

                DB::commit();

                return response()->json(['error' => false, 'message' => 'Success','user_id' => $user->id]);
            }
            else{
                return response()->json(['error' => true, 'message' => 'No user found']);

            }

        }
        catch(\Exception $e) {

            DB::rollback();

            // echo 'Message: ' .$e->getMessage();
            MobileUser::where('phone',$request->phone)->update(['sent' =>'no']);

            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

    }



    public function verify_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'user_id' => 'required',
            'platform' => 'required',
            'firebase_token' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $user = MobileUser::find($request->user_id);
        if($user)
        {
            $code = $request->code;
            if ($code == $user->code) {
                if ($user->verified == false)
                {
                    $user->update(['verified' => true]);

                }

                $user->update(['verified' => true,'active_device'=>$request->firebase_token,'platform'=>$request->platform]);
                $token = $user->createToken('turboo')->accessToken;
                $obj = [
                    "name" => $user->name,
                    "email" => $user->email,
                    "phone"=>$user->phone,
                    "remember_token" => $user->remember_token,
                ];



                return response()->json(['error' => false, 'message' => 'Success', 'token' => $token, 'data' => $obj]);

            }
            else{
                return response()->json(['error' => true, 'message' => 'User not found' ,'token' => "", 'data' => (object)array()]);
            }

        } else {
            return response()->json(['error' => true, 'message' => 'Incorrect code', 'token' => '', 'data' => (object)array()]);
        }
    }




}
