<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\BusinessInfo;
use App\BusinessImage;
use App\City;
use App\FavouriteBusiness;
use App\Http\Requests\BusinessRequest;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BusinessInfoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses=BusinessInfo::with('users')->get();
        return view('business_users.businesses',compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities=City::all();
        $categories=BusinessCategory::all();
        return view('business_users.add',compact('cities','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $file=$request->image;
        $banner=$request->banner;
        $user=new User();
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->role=User::business;
        $user->password = bcrypt(strtolower('turbo1234'));
        $user->user_create_id = Auth::user()->id;
        $user->created_at = date("Y-m-d H:i:s");
        if($user->save())
        {
            $business= new BusinessInfo();
            $business->user_id=$user->id;
            $business->business_name=$request->business_name;
            $business->business_category_id=$request->category;
            $business->nuis=$request->nuis;
            $business->city_id=$request->city;
            $business->url=$request->url;
            $business->address=$request->address;
            $business->description=$request->desc;
            $business->open=date('H:i:s',strtotime($request->open));
            $business->close=date('H:i:s',strtotime($request->close));
            $business->weekend_open=date('H:i:s',strtotime($request->weekend_open));
            $business->weekend_close=date('H:i:s',strtotime($request->weekend_close));
            $path='business';

            //postal system
            $business->api_id=$request->api_id;



            if($file){
                $business->image= (new \App\ImageUpload)->image_upload($file,$path);
            }
            if($banner){
                $business->banner= (new \App\ImageUpload)->image_upload($banner,$path);
            }

            if($business->save()) {
                return redirect()->route('business.index')->with('success', sprintf('Business was saved successfully.'));
            }
            else{
                User::where('id',$user->id)->delete();
                return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
            }
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessInfo  $businessInfo
     * @return \Illuminate\Http\Response
     */
    public function view_business_details($id)
    {
        $business=BusinessInfo::where('user_id',$id)->with('users')->firstOrFail();
        $products=Product::where('business_id',$id)->get();

        return view('business_users.business_details',compact('business','products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessInfo  $businessInfo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities=City::all();
        $business=BusinessInfo::where('user_id',$id)->with('users')->firstOrFail();
        $categories=BusinessCategory::all();

        return view('business_users.edit',compact('business','cities','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessInfo  $businessInfo
     * @return \Illuminate\Http\Response
     */
    public function update(BusinessRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $file=$request->image;
        $banner=$request->banner;
        $path='business';
        $user=User::find($id);
        $user->name=$request->name;
        $user->surname=$request->surname;
        $user->email=$request->email;
        $user->phone=$request->phone;
        if($request->password=='yes') {
            $user->password=bcrypt('turbo1234');
        }
        $user->status = $request->status;
        $user->user_update_id = Auth::user()->id;
        $user->created_at = date("Y-m-d H:i:s");
        if($user->save())
        {
            $business=BusinessInfo::where('user_id',$id)->first();
            $business->user_id=$user->id;
            $business->business_name=$request->business_name;
            $business->business_category_id=$request->category;
            $business->nuis=$request->nuis;
            $business->city_id=$request->city;
            $business->url=$request->url;
            $business->address=$request->address;
            $business->description=$request->desc;
            $business->user_update_id=Auth::user()->id;
            $business->open=date('H:i:s',strtotime($request->open));
            $business->close=date('H:i:s',strtotime($request->close));
            $business->weekend_open=date('H:i:s',strtotime($request->weekend_open));
            $business->weekend_close=date('H:i:s',strtotime($request->weekend_close));


            //postal system
            $business->api_id=$request->api_id;

            if($file){
                $business->image= (new \App\ImageUpload)->image_upload($file,$path);
            }
            if($banner){
                $business->banner= (new \App\ImageUpload)->image_upload($banner,$path);
            }

            if($business->save()) {
                return redirect()->route('business.index')->with('success', sprintf('Business was saved successfully.'));
            }
            else{
                User::where('id',$user->id)->delete();
                return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
            }
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function business_profile()
    {
        $business=BusinessInfo::where('user_id',Auth::id())->with('users')->firstOrFail();
        $business_images=BusinessImage::where('business_id',Auth::id())->get();
        return view('business_users.business_profile',compact('business','business_images'));
    }

    public function edit_business_profile()
    {
        $business=BusinessInfo::where('user_id',Auth::id())->with('users')->firstOrFail();
        $cities=City::all();

        return view('business_users.edit_profile',compact('business','cities'));
    }

    public function update_business_profile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_name' => 'required|max:191',
            'address' => 'required|max:191',
            'desc' => 'required',
            'nuis' => 'required|max:30',
            'city' => 'required',
            'open' => 'required',
            'close' => 'required',
            'weekend_open' => 'required',
            'weekend_close' => 'required',
            'url' => 'max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf($validator->errors()->all()[0]));
        }


        $file=$request->image;
        $banner=$request->banner;
        $path='business';
        $business=BusinessInfo::where('user_id',Auth::id())->firstOrFail();
        $business->business_name=$request->business_name;
        $business->nuis=$request->nuis;
        $business->city_id=$request->city;
        $business->url=$request->url;
        $business->address=$request->address;
        $business->description=$request->desc;
        $business->delivery_price=$request->delivery;
        $business->user_update_id=Auth::user()->id;
        $business->open=date('H:i:s',strtotime($request->open));
        $business->close=date('H:i:s',strtotime($request->close));
        $business->weekend_open=date('H:i:s',strtotime($request->weekend_open));
        $business->weekend_close=date('H:i:s',strtotime($request->weekend_close));
        if($file){
            $business->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($banner){
            $business->banner= (new \App\ImageUpload)->image_upload($banner,$path);
        }

        if($business->save()) {
            return redirect()->route('business.profile')->with('success', sprintf('Info was updated successfully.'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessInfo  $businessInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id){

        $business=BusinessInfo::where('user_id',$id)->first();

//        if(Product::where('business_id',$id)->exists())
//      {
//            return redirect()->back()->with('error', sprintf('You are not allowed to delete this business!'));
//
//        }

        if($business->delete()) {
            if(User::find($id)->delete()){
                return redirect()->back()->with('success', sprintf('Business was deleted successfully'));
            }
            else{
                   return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
                }
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }

    }


    public function business_images()
    {
        $images=BusinessImage::where('business_id',Auth::id())->get();
        return view('business_users.business_images',compact('images'));
    }

    public function delete_business_image($id)
    {
        $image=BusinessImage::find($id);
        if($image->delete()){
            return redirect()->back()->with('success', sprintf('Image was deleted successfully.'));

        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }

    }

    public function add_business_images(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf($validator->errors()->all()[0]));
        }
        $files=$request->images;
        $path='business';
        if($files){
            foreach ($files as $item) {
                $image= new BusinessImage();
                $image->business_id=Auth::id();
                $image->image= (new \App\ImageUpload)->image_upload($item,$path);
                $image->save();
            }
            return redirect()->back()->with('success', sprintf('Success'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }
    }



    public function highlighted_businesses()
    {
        $businesses=FavouriteBusiness::get();
        $businesses_id=FavouriteBusiness::pluck('business_id');
        $business_infos=BusinessInfo::where('user_id','!=',$businesses_id)->get();
        return view('business_users.favourite_businesses',compact('businesses','business_infos'));
    }

    public function add_highlighted_businesses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf($validator->errors()->all()[0]));
        }

        $favourite=new FavouriteBusiness();
        $favourite->business_id=$request->business;
        $favourite->user_create_id=Auth::id();
        if($favourite->save()) {
            return redirect()->back()->with('success', sprintf('Success'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }
    }

    public function delete_highlighted_businesses($id)
    {
        $favourite=FavouriteBusiness::find($id);
        if($favourite->delete()){
            return redirect()->back()->with('success', sprintf('Business was deleted successfully.'));

        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }
    }

}
