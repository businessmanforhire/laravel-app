<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivacyPolicy;
use Illuminate\Support\Facades\Validator;

class ConfigurationController extends Controller
{

    public function privacy_policy()
    {
        $policy=PrivacyPolicy::first();
        return view ('configurations.privacy_policy',compact('policy'));
    }


    public function submit_privacy_policy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $policy=PrivacyPolicy::first();
        $policy->text=$request->text;
        if($policy->save()){
            return redirect()->route('privacy_policy')->with('success', sprintf('Privacy Policy was saved successfully.'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

}
