<?php

namespace App\Http\Controllers;

use App\MobileUser;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=MobileUser::all();
        return view('mobile_users.index',compact('users'));
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
     * @param  \App\MobileUser  $mobileUser
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=MobileUser::findOrFail($id);
        $orders=Order::where('mobile_user_id',$id)->get();
        return view('mobile_users.order_history',compact('user','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileUser  $mobileUser
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileUser $mobileUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileUser  $mobileUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->all()[0]]);
        }

        $user = MobileUser::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        if ($user->save()) {
            return redirect()->back()->with('success', sprintf('User was updated successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileUser  $mobileUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileUser $mobileUser)
    {
        //
    }
}
