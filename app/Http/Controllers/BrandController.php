<?php

namespace App\Http\Controllers;

use App\Brand;
use App\BusinessInfo;
use App\Http\Requests\BrandRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands=Brand::all();
        return view('brands.brand',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $brand=new Brand();
        $brand->name=$request->name;
        $brand->user_create_id = Auth::user()->id;
        $brand->created_at = date("Y-m-d H:i:s");
        $path='category';
        if($file){
            $brand->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($brand->save()) {
            return redirect()->back()->with('success', sprintf('Brand was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function store_subcategory(BrandRequest $request,$id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $brand=new Brand();
        $brand->name=$request->name;
        $brand->user_create_id = Auth::user()->id;
        $brand->created_at = date("Y-m-d H:i:s");
        $path='category';
        if($file){
            $brand->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($brand->save()) {
            return redirect()->back()->with('success', sprintf('Category was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $brand=Brand::findorFail($id);
        $brand->name=$request->name;
        $brand->visible=$request->visible;
        $brand->user_update_id = Auth::user()->id;
        $brand->updated_at = date("Y-m-d H:i:s");
        $path='category';
        if($file){
            $brand->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($brand->save()) {
            return redirect()->back()->with('success', sprintf('Brand was updated successfully.'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand=Brand::findOrFail($id);
        if($brand->delete()) {
            return redirect()->back()->with('success', sprintf('Brand was deleted successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }

    }
}
