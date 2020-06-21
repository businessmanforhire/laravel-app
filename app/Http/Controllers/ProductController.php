<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\ProductExport;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductsImport;
use App\Product;
use App\Brand;
use App\ProductReview;
use App\ProductImage;
use App\ProductSize;
use App\BusinessInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::where('business_id',Auth::id())->where('visible',Product::visible)->get();
        return view('products.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business_cat=BusinessInfo::where('user_id',Auth::id())->value('business_category_id');
        $categories=Category::where('business_category_id','=',$business_cat)->get();
        $brands=Brand::where('visible','=',Brand::visible)->get();

        return view('products.add',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $product_sizes=$request->input('group-a');
        $file=$request->image; $files=$request->images;
        $product=new Product();
        $product->name=$request->name;
        $product->category_id=$request->category;
        $product->brand_id=$request->brand;
        $product->business_id=Auth::user()->id;
        $product->price=$request->price;
        $product->description=$request->desc;
        $product->user_create_id = Auth::user()->id;
        $product->created_at = date("Y-m-d H:i:s");
        if($request->is_offer==Product::is_offer){
            $product->is_offer=Product::is_offer;
            $product->discount=$request->discount;

        } else{
            $product->is_offer=Product::not_offer;
        }

        $path='products';
        if($file){
            $product->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($product->save())
        {
            //saving multiple images
            if($files){
                foreach ($files as $item) {
                        $image= new ProductImage();
                        $image->product_id=$product->id;
                        $image->image= (new \App\ImageUpload)->image_upload($item,$path);
                        $image->save();
                }

            }

            //saving quantity
            if($request->specification=='yes'){
                Product::where('id',$product->id)->update(['is_specific'=>'yes']);
                foreach ($product_sizes as $item){
//                    dd($item);
                    $size=new ProductSize();
                    $size->product_id=$product->id;
                    $size->size=$item['size'];
                    $size->quantity=$item['quantity'];
                    $size->user_create_id=Auth::id();
                    $size->created_at=date("Y-m-d H:i:s");
                    $size->save();
                    }
            } else{
                Product::where('id',$product->id)->update(['is_specific'=>'no']);
                Product::where('id',$product->id)->update(['quantity'=>$request->quantity]);
            }


            return redirect()->route('product.index')->with('success', sprintf('Product was saved successfully.'));

        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function product_review(){

        $reviews=ProductReview::where('business_id',Auth::id())->get();
        return view('reviews.product_reviews',compact('reviews'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $categories=Category::where('business_category_id','!=',null)->get();
        $brands=Brand::where('visible','=',Brand::visible)->get();
        return view('products.edit',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return redirect()->back()->with('error', sprintf($request->validator->messages()->all()[0]));
        }

        $file=$request->image;$product_sizes=$request->input('group-a'); 
        $product=Product::findOrFail($id);
        $product->name=$request->name;
        $product->category_id=$request->category;
        $product->brand_id=$request->brand;
        $product->business_id=Auth::user()->id;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->description=$request->desc;
        $product->visible=$request->visible;
        $product->user_create_id = Auth::user()->id;
        $product->created_at = date("Y-m-d H:i:s");
        if($request->is_offer==Product::is_offer){
            $product->is_offer=Product::is_offer;
            $product->discount=$request->discount;
        } else{
            $product->is_offer=Product::not_offer;
        }
        $path='products';
        if($file){
            $product->image= (new \App\ImageUpload)->image_upload($file,$path);
        }
        if($product->save())
        {
            if($request->specification=='yes'){
                Product::where('id',$id)->update(['is_specific'=>'yes']);
              
            } else{
                Product::where('id',$id)->update(['is_specific'=>'no']);
                Product::where('id',$product->id)->update(['quantity'=>$request->quantity]);
            }

            return redirect()->route('product.index')->with('success', sprintf('Product was updated successfully.'));

        }
        else {
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }


    public function importProductExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        DB::beginTransaction();
        try {
            $import = new ProductsImport();
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
                return redirect()->back()->with('success', sprintf('Product imported successfully'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', sprintf('Error'));
        }
    }

    public function export_products_format()
    {
        return Excel::download(new ProductExport(), 'products_format.xlsx');
    }


   public function product_images($id)
   {
       $images=ProductImage::where('product_id',$id)->get();
       return view('products.images',compact('images'));
   }

   public function delete_image($id)
   {
       $image=ProductImage::find($id);
       if($image->delete()){
           return redirect()->back()->with('success', sprintf('Image was deleted successfully.'));

       }
       else{
           return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

       }

   }


    public function  product_size($id)
    {
        $sizes=ProductSize::where('product_id',$id)->get();
        $product_id=$id;
        return view('products.product_size',compact('sizes','product_id'));
    }

    public function create_product_size(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'size' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $size=new ProductSize();
        $size->size=$request->size;
        $size->quantity=$request->quantity;
        $size->product_id=$id;
        $size->user_create_id = Auth::user()->id;
        $size->created_at = date("Y-m-d H:i:s");
        if($size->save()) {
            return redirect()->back()->with('success', sprintf('Size was saved successfully.'));
        }
        else{

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }

    public function update_product_size(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'size' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', sprintf( $validator->errors()->all()[0]));
        }
        $size=ProductSize::findOrFail($id);
        $size->size=$request->size;
        $size->quantity=$request->quantity;
        $size->user_update_id = Auth::user()->id;
        $size->visible=$request->visible;

        $size->updated_at = date("Y-m-d H:i:s");
        if($size->save()) {
            return redirect()->back()->with('success', sprintf('Size was saved successfully.'));
        }
        else{
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));
        }
    }





public function product_datatable(Request $request)
{
        $columns = array(
            0 => 'image',
            1 => 'name',
            2 => 'category',
            3 => 'price',
            4 => 'quantity',
            5 => 'visible',
            6 => 'date',
            7 => 'actions',
        );


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        $totalData = Product::where('business_id',Auth::id())->count();
        $totalFiltered = $totalData;

        if (empty($request->input('search.value'))) {
            $products = Product::offset($start)
                -> where('business_id',Auth::id())
                ->limit($limit)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $search = $request->input('search.value');

            $category=Category::where('name', 'LIKE', "%{$search}%")->first();
            if($category) $id=$category->id;
            else $id=0;

            $products = Product::where('name', 'LIKE', "%{$search}%") -> where('business_id',Auth::id())

                ->orWhere('category_id',$id)
                ->offset($start)
                ->limit($limit)
                ->orderBy('created_at', 'desc')
                ->get();


            $totalFiltered = Product::where('name', 'LIKE', "%{$search}%")
                -> where('business_id',Auth::id())
                ->orWhere('category_id',$id)
                ->count();
        }


        $data = array();


        if (!empty($products)) {

            foreach ($products as $product) {
                if ($product->image != null) {
                    if (Storage::disk('public')->exists('image/products/' . $product->image))
                        $img = asset('image/products/' . $product->image);
                    else $img = asset('storage/' . $product->image);
                } else
                    $img = 'https://sisterhoodofstyle.com/wp-content/uploads/2018/02/no-image-1.jpg';

                if($product->is_specific=='yes') {
                    $specific='<a type = "button" class="btn btn-icon btn-warning btn-lighten-1 btn-sm"  href="' . route('product_size',$product->id). '" > Edit Quantity </a >';
                } else{
                    $specific='';
                }

                $star_review='';
                $stars = number_format(ProductReview::where('product_id',$product->id)->avg('review'), 3, '.', ',') ; $stars = round($stars,0);
                for($i= 1;$i<=$stars;$i++)
                      if($i<=5)
                      {
                          $star_review.=' <i class="ft-star warning "></i>';

                      }
                    if(5-$stars > 0)
                    {
                        for($i= 1;$i<=5-$stars;$i++)
                        {
                            $star_review.=' <i class="ft-star"></i>';
                        }
                    }



                $nestedData['image'] = '<img src="' . $img . '" alt="" style="width: 80px;height: 80px;object-fit: contain"/>';
                $nestedData['name'] = $product->name.''.$star_review;
                $nestedData['category'] = Category::find($product->category_id)->name;
                $nestedData['price'] = $product->price ;
                $nestedData['quantity'] = $product->quantity ;

                if ($product->visible == true)
                    $nestedData['visible'] = '<span class="badge badge-success lighten-1 col-md-10">Visible</span>';
                else
                    $nestedData['visible'] = '<span class="badge badge-danger lighten-1 col-md-10">Not Visible</span>';


                $nestedData['date'] =  'Created at: <em><b>' . date('d M Y, H:i ', strtotime($product->created_at)) . '</b></em> <br>'.
               'Updated at: <em><b>' . date('d M Y, H:i ', strtotime($product->updated_at)) . '</b></em>';



                $nestedData['actions'] = '<div class="form-group"><a type="button" class="btn btn-icon btn-primary btn-lighten-1 btn-sm" href="' . route('product.edit',$product->id) . '"  ><i class="la la-edit"></i></a>
                  <a type="button" class="btn btn-icon btn-warning btn-lighten-1 btn-sm" href="' . route('product_images',$product->id) . '"  ><i class="la la-image"></i></a>
                                         </div> '.$specific;

                $data[] = $nestedData;
            }

        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );


        echo json_encode($json_data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
