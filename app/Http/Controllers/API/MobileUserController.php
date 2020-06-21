<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;

class MobileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info=MobileUser::find(Auth::id());
        if($info){
            $object=[
                "id" => $info->id,
                "name" => $info->name,
                "email" => $info->email,
                "phone"=>$info->phone,
                "date_of_birth"=>is_null($info->date_of_birth)? "" :$info->date_of_birth,
                "image"=>is_null($info->image)? "" :$info->image,
                "remember_token" => is_null($info->remember_token)? "" :$info->remember_token,
            ];
            return response()->json(
                [
                    'error' => false,
                    'message' => 'Success',
                    'data' => $object
                ],200
            );
        }
        else{
            return response()->json(
                [
                    'error' => false,
                    'message' => 'Success',
                    'data' => (object)array()
                ],200
            );
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'date_of_birth' => 'date_format:Y-m-d|before:today'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $file=$request->image;
        $user=MobileUser::find(Auth::id());
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth));
        $path='users';
        if($file){
            $user->image= (new \App\ImageUpload)->image_upload($file,$path);
        }

        

        if($user->save()){
            return response()->json(
                [
                    'error' => false,
                    'message' => 'Profile was updated successfully',
                ],200
            );
        }
        else{
            return response()->json(
                [
                    'error' => false,
                    'message' => 'An error has occurred',
                ],404
            );
        }



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
}
