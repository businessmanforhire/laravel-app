<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\SubscriptionTime;


class SubscriptionTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions=SubscriptionTime::all();
        return view('subscription.subscription_time',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'number' => 'required|unique:subscription_times',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $subscription=new SubscriptionTime();
        $subscription->title=$request->title;
        $subscription->number=$request->number;
        $subscription->user_create_id=Auth::id();
        $subscription->created_at = date("Y-m-d H:i:s");

        if($subscription->save()) {
            return redirect()->route('subscription_time.index')->with('success', sprintf('Subscription was saved successfully.'));
        } else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'number' => 'required|unique:subscription_times',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $subscription=SubscriptionTime::findOrFail($id);
        $subscription->title=$request->title;
        $subscription->number=$request->number;
        $subscription->visible=$request->visible;
        $subscription->user_update_id=Auth::id();
        $subscription->updated_at=date("Y-m-d H:i:s");;

        if($subscription->save()) {
            return redirect()->route('subscription_time.index')->with('success', sprintf('Subscription was updated successfully.'));
        } else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
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
        $subscription=SubscriptionTime::findOrFail($id);
        if($subscription->delete()) {
            return redirect()->back()->with('success', sprintf('Subscription was deleted successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }

    }
}
