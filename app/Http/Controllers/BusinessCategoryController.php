<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\BusinessInfo;
use App\Category;
use App\Http\Requests\CategoryRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=BusinessCategory::all();
        return view('business_category.index',compact('categories'));
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
    public function store(CategoryRequests $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $category=new BusinessCategory();
        $category->name=$request->name;
        $category->user_create_id = Auth::user()->id;
        $category->created_at = date("Y-m-d H:i:s");
        $path='category';
        if($file){
            $category->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($category->save()) {
            return redirect()->back()->with('success', sprintf('Category was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessCategory $businessCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessCategory $businessCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequests $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $category=BusinessCategory::findorFail($id);
        $category->name=$request->name;
        $category->visible=$request->visible;
        Category::where('business_category_id',$id)->update(['visible'=>$request->visible]);
        $category->user_update_id = Auth::user()->id;
        $category->updated_at = date("Y-m-d H:i:s");
        $path='category';
        if($file){
            $category->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($category->save()) {
            return redirect()->back()->with('success', sprintf('Category was updated successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessCategory  $businessCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business_category=BusinessCategory::findOrFail($id);

        if(BusinessInfo::where('business_category_id',$id)->exists())
        {
            return redirect()->back()->with('error', sprintf('You are not allowed to delete this category'));
        }

        if($business_category->delete()) {
            return redirect()->back()->with('success', sprintf('Category was deleted successfully'));
        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }

    }
}
