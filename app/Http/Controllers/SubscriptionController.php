<?php

namespace App\Http\Controllers;

use App\BusinessInfo;
use App\Subscription;
use App\BusinessSubscription;
use App\SubscriptionTime;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $subscriptions=Subscription::all();
         return view('subscription.index',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subscription.add');
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
            'title' => 'required|max:191',
            'description' => 'required',
            'price' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $subscription=new Subscription();
        $subscription->title=$request->title;
        $subscription->description=$request->description;
        $subscription->price=$request->price;
        $subscription->user_create_id=Auth::id();
        if($subscription->save()) {
            return redirect()->route('subscription.index')->with('success', sprintf('Subscription was saved successfully.'));
        } else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }


    public function view_subscribers($id)
    {
        $subscriptions=BusinessSubscription::where('subscription_id',$id)->get();
        $subcribed_business=BusinessSubscription::pluck('business_id');

        $businesses=BusinessInfo::whereNotIn('user_id',$subcribed_business)->get();

        $months=SubscriptionTime::where('visible',1)->get();
        $sub_id=$id;
        return view('subscription.subscription_user',compact('subscriptions','businesses','months','sub_id'));
    }

    public function add_subscriber(Request $request,$sub_id)
    {
        $validator = Validator::make($request->all(), [
            'business' => 'required',
            'month' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $date_now=Carbon::now();
        $subscription=new BusinessSubscription();
        $subscription->subscription_id=$sub_id;
        $subscription->comment=$request->comment;
        $subscription->business_id=$request->business;
        $subscription->month_id=$request->month;
        $subscription->start_date=Carbon::now();
        $month=(int)SubscriptionTime::find($request->month)->number;
        $subscription->end_date=$date_now->addMonths($month);
        $subscription->user_create_id=Auth::id();
        if($subscription->save()) {
            return redirect()->back()->with('success', sprintf('Subscription was saved successfully.'));
        } else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function update_subscriber(Request $request,$sub_id,$id)
    {
        $validator = Validator::make($request->all(), [
            'business' => 'required',
            'month' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }

        $date_now=Carbon::now();
        $subscription= BusinessSubscription::findOrFail($id);
        $subscription->subscription_id=$sub_id;
        $subscription->comment=$request->comment;
        $subscription->business_id=$request->business;
        $subscription->month_id=$request->month;
        $subscription->start_date=Carbon::now();
        $month=(int)SubscriptionTime::find($request->month)->number;
        $subscription->end_date=$date_now->addMonths($month);
        $subscription->user_create_id=Auth::id();
        if($subscription->save()) {
            return redirect()->back()->with('success', sprintf('Subscription was updated successfully.'));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription=Subscription::find($id);
        return view('subscription.edit',compact('subscription'));
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
            'description' => 'required',
            'price' => 'required',
            'visible' => 'required',
            ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $subscription=Subscription::findOrFail($id);
        $subscription->title=$request->title;
        $subscription->description=$request->description;
        $subscription->price=$request->price;
        $subscription->visible=$request->visible;
        $subscription->user_update_id=Auth::id();

        if($subscription->save()) {
            return redirect()->route('subscription.index')->with('success', sprintf('Subscription was saved successfully.'));
        } else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
