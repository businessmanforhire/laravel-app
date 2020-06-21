<?php

namespace App\Http\Controllers\API;

use App\BusinessInfo;
use App\Category;
use App\Brand;
use App\FavouriteProduct;
use App\ProductReview;
use App\ProductImage;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductSize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $categories=Product::where('business_id',$id)->groupBy('category_id')->pluck('category_id');
        $data = array(); $data_products=array();
        if($categories) {
            foreach ($categories as $category) {
                $products = Product::where('category_id' , $category)->where('business_id',$id)->take(100)->get();
                foreach ($products as $product) {
                    $ratings=number_format(ProductReview::where('product_id',$product->id)->avg('review'), 2, '.', ',');
                    $nr=number_format(ProductReview::where('product_id',$product->id)->count('id'));

                    $sizes=ProductSize::where('product_id',$id)->get();
                    $data_size=array();
                    foreach ($sizes as $sizes){
                        $data_s = [
                            'id'=>$sizes->id,
                            'size'=>$sizes->size
                        ];
                        array_push($data_size, $data_s);

                    }


                    $obj = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' => floatval($product->price),
                        'is_offer'=> $product->is_offer=='1' ? true :false,
                        'discount' =>$product->is_offer=='1' ? $product->discount :0,
                        'description' => $product->description,
                        'favourite'=> FavouriteProduct::where('product_id',$product->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
                        'ratings'=>$ratings,
                        'nr'=>$nr,
                        'business_id'=>$product->business_id,
                        'business_name'=>$product->business->business_name,
                        'brand'=>is_null($product->brand) ?'' :$product->brand,
                        'is_specific'=>$product->is_specific=='yes' ? true : false,
                        'size'=>$data_size,

                    ];
                    array_push($data_products, $obj);
                }

                $object = [
                    'category_id' => $category,
                    'category_name' => Category::find($category)->name,
                    'products' => $data_products
                ];
                array_push($data, $object);
            }

            return response()->json(
                [
                    'error' => false,
                    'message' => 'Success',
                    'data' => $data
                ],200
            );
        }
        else{
            return response()->json(
                [
                    'error' => false,
                    'message' => 'No data found',
                    'data' => $data
                ],200
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store_favourite_product(Request $request){


        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        if(FavouriteProduct::where('product_id',$request->product_id)->where('mobile_user_id',Auth::id())->exists()){
            return response()->json(
                [
                    'error' => true,
                    'message' => 'You are not allowed to do this action',
                ],403
            );
        }

        $product=new FavouriteProduct();
        $product->mobile_user_id=Auth::id();
        $product->product_id=$request->product_id;
        if($product->save()) {
            return response()->json(
                [
                    'error' => false,
                    'message' => 'Success',
                ],200
            );
        } else {
            return response()->json(
                [
                    'error' => true,
                    'message' => 'Error',
                ],404
            );
        }
    }


    public function get_favourite_product()
    {
        $data_products=array();
        $products = FavouriteProduct::join('products','favourite_products.product_id','products.id')
            ->where('mobile_user_id', Auth::id())->get();
        foreach ($products as $product) {
            $ratings=number_format(ProductReview::where('product_id',$product->id)->avg('review'), 2, '.', ',');
            $nr=number_format(ProductReview::where('product_id',$product->id)->count('id'));

            $obj = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => floatval($product->price),
                'is_offer'=> $product->is_offer=='1' ? true :false,
                'discount' =>$product->is_offer=='1' ? $product->discount :0,
                'category'=>Category::find($product->category_id)->name,
                'ratings'=>$ratings,
                'nr'=>$nr,
                'favourite'=> FavouriteProduct::where('product_id',$product->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
                'business_id'=>$product->business_id,
                'business_name'=>BusinessInfo::where('user_id',$product->business_id)->value('business_name'),
                'brand'=>is_null($product->brand) ?'' :$product->brand


            ];
            array_push($data_products, $obj);
        }
        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
                'data' => $data_products
            ],200
        );
    }

    public function delete_favourite_product($id){
        FavouriteProduct::where('mobile_user_id', Auth::id())->where('product_id',$id)->forceDelete();
        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
            ],200
        );
    }

    public function  product_review(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }
        $review= new ProductReview();
        $review->mobile_user_id = Auth::id();
        $review->product_id = $id;
        $review->business_id = Product::find($id)->business_id;
        $review->review = $request->review;
        $review->comment = $request->comment;
        if ($review->save()) {
            return response()->json([
                'error' => false,
                'message' =>'Success'
            ],201);
        } else {
            return response()->json([
                'error' => true,
                'message' =>'An error has occured',
            ],404);
        }

    }


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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(); $data_products=array(); $data_images=array();
        $product=Product::find($id);
        if($product) {
            $ratings = number_format(ProductReview::where('product_id', $product->id)->avg('review'), 2, '.', ',');
            $nr = number_format(ProductReview::where('product_id', $product->id)->count('id'));
            $images=ProductImage::where('product_id',$id)->get();
            foreach ($images as $image){
                $data_im = [
                    'image'=>$image->image
                ];
                array_push($data_images, $data_im);

            }

            $sizes=ProductSize::where('product_id',$id)->get();
            $data_size=array();
            foreach ($sizes as $sizes){
                $data_s = [
                    'id'=>$sizes->id,
                    'size'=>$sizes->size
                ];
                array_push($data_size, $data_s);

            }

            $obj = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => floatval($product->price),
                'is_offer' => $product->is_offer == '1' ? true : false,
                'discount' => $product->is_offer == '1' ? $product->discount : 0,
                'description' => $product->description,
                'favourite' => FavouriteProduct::where('product_id', $product->id)->where('mobile_user_id', Auth::id())->exists() ? true : false,
                'ratings' => $ratings,
                'nr' => $nr,
                'business_id' => $product->business_id,
                'business_name' => $product->business->business_name,
                'product_images'=>$data_images,
                'is_specific'=>$product->is_specific=='yes' ? true : false,
                'size'=>$data_size,
                'brand'=>is_null($product->brand) ?'' :$product->brand

            ];

            $category_id = Product::find($id)->category_id;
            $related_products = Product::where('category_id', $category_id)->where('id','!=',$id)->where('business_id',$product->business_id)->take(100)->get();
            foreach ($related_products as $product) {
                $ratings = number_format(ProductReview::where('product_id', $product->id)->avg('review'), 2, '.', ',');
                $nr = number_format(ProductReview::where('product_id', $product->id)->count('id'));

                $object = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => floatval($product->price),
                    'is_offer' => $product->is_offer == '1' ? true : false,
                    'discount' => $product->is_offer == '1' ? $product->discount : 0,
                    'category' => Category::find($product->category_id)->name,
                    'ratings' => $ratings,
                    'nr' => $nr,
                    'favourite' => FavouriteProduct::where('product_id', $product->id)->where('mobile_user_id', Auth::id())->exists() ? true : false,
                    'business_id' => $product->business_id,
                    'business_name' => $product->business->business_name,
                    'brand'=>is_null($product->brand) ?'' :$product->brand


                ];
                array_push($data_products, $object);
            }


                return response()->json(
                    [
                        'error' => false,
                        'message' => 'Success',
                        'product_detail' => $obj,
                        'related_products'=>$data_products
                    ], 200
                );
            }

        else {
            return response()->json([
                'error' => true,
                'message' =>'An error has occured',
            ],404);
        }

    }


    public function brands(){

        $brands = Brand::where('visible',Brand::visible)->get();
        $data = array();
        foreach ($brands as $brand) {
            $object = [
                'id' => $brand->id,
                'name' => $brand->name,
                'image' => $brand->image,
            ];
            array_push($data, $object);
        }

        return response()->json([
            'error' => false,
            'message' => 'Success',
            'data' => $data,
        ],200);
    }



    public function products_by_brand($id)
    {
        $products = Product::where('brand_id','=',$id)->get();
        $data = array();
        foreach ($products as $product) {
            $ratings=number_format(ProductReview::where('product_id',$product->id)->avg('review'), 2, '.', ',');
            $nr=number_format(ProductReview::where('product_id',$product->id)->count('id'));
            $object = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => floatval($product->price),
                'is_offer'=> $product->is_offer=='1' ? true :false,
                'discount' =>$product->is_offer=='1' ? $product->discount :0,
                'description' => $product->description,
                'favourite'=> FavouriteProduct::where('product_id',$product->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
                'ratings'=>$ratings,
                'nr'=>$nr,
                'business_id'=>$product->business_id,
                'business_name'=>$product->business->business_name,
                'brand'=>is_null($product->brand) ?'' :$product->brand
            ];
            array_push($data, $object);
        }

        return response()->json([
            'error' => false,
            'message' => 'Success',
            'data' => $data,
        ],200);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
