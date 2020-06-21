<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use App\Category;
use App\Http\Requests\CategoryRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CategoryImport;
use App\Exports\CategoryExport;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.categories',compact('categories'));
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
    public function store(CategoryRequests $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $category=new Category();
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

    public function store_subcategory(CategoryRequests $request,$id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $category=new Category();
        $category->business_category_id=$id;
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat_id=$id;
        BusinessCategory::findOrFail($id);
        $categories=Category::where('business_category_id',$id)->get();
        return view('categories.subcategories',compact('categories','cat_id'));
    }

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
    public function update(CategoryRequests $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }
        $file=$request->image;
        $category=Category::findorFail($id);
        $category->name=$request->name;
        $category->visible=$request->visible;
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        if($category->delete()) {
                return redirect()->back()->with('success', sprintf('Category was deleted successfully'));
                }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred , please try again later!'));
        }

    }

    public function importCategory(Request $request, $cat_id){
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        DB::beginTransaction();
        try {
            $import = new CategoryImport($cat_id);
            $import->import($request->file);
            if ($import->failures()->count() > 0) {
                $message = '';
                foreach ($import->failures() as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                    $failure->values(); // The values of the row that has failed.
                    $message .= ' Row: ' . $failure->row() . ' Column: ' . $failure->attribute() . '<br>';
                }
                DB::rollback();
                Session::flash('message', 'Error found in : <br>' . $message);
                return redirect()->back();
            } else {
                DB::commit();
                return redirect()->back()->with('success', sprintf('Category imported successfully'));
                }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', sprintf('Error'));
        }
    }


    public function export_category_format()
    {
        return Excel::download(new CategoryExport(), 'category_format.xlsx');
    }






}
