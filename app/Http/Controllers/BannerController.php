<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BusinessInfo;
use App\Http\Requests\BannerRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::all();
        $products=Product::where('visible',Product::visible)->get();
        $businesses=BusinessInfo::get();

        return view('banner.index',compact('banners','products','businesses'));
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
    public function store(BannerRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $banner=new Banner();
        $banner->text=$request->text;
        $banner->user_create_id = Auth::user()->id;
        $banner->created_at = date("Y-m-d H:i:s");
        $banner->type=$request->specification;
        if($banner->type=='product'){
            if( isset($request->product))  $banner->type_id=$request->product;
            else    return redirect()->back()->with('error', sprintf('Please choose a product'));

        }
        else if($banner->type=='business'){
            if( isset($request->business))    $banner->type_id=$request->business;
            else return redirect()->back()->with('error', sprintf('Please choose a business'));

        }
        else if($banner->type=='url'){
            if( isset($request->url))  $banner->type_id=$request->url;
            else return redirect()->back()->with('error', sprintf('Please put url '));

        }
        $path='banner';
        if($file){
            $banner->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($banner->save()) {
            return redirect()->back()->with('success', sprintf('Banner was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $banner=Banner::findorFail($id);
        $banner->text=$request->text;
        $banner->visible=$request->visible;
        $banner->user_update_id = Auth::user()->id;
        $banner->updated_at = date("Y-m-d H:i:s");
        if($banner->type=='product'){
            if( isset($request->product))  $banner->type_id=$request->product;
            else    return redirect()->back()->with('error', sprintf('Please choose a product'));

        }
        else if($banner->type=='business'){
            if( isset($request->business))    $banner->type_id=$request->business;
            else return redirect()->back()->with('error', sprintf('Please choose a business'));

        }
        else if($banner->type=='url'){
            if( isset($request->url))  $banner->type_id=$request->url;
            else return redirect()->back()->with('error', sprintf('Please put url '));

        }
        $path='banner';
        if($file){
            $banner->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($banner->save()) {
            return redirect()->back()->with('success', sprintf('Banner was updated successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner=Banner::findOrFail($id);
        if($banner->delete()) {
            return redirect()->back()->with('success', sprintf('Banner was deleted successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }
    }
}
