<?php

namespace App\Http\Controllers\API;

use App\Banner;
use App\PreferredBusiness;
use App\BusinessCategory;
use App\BusinessInfo;
use App\Category;
use App\Coupon;
use App\CouponType;
use App\PrivacyPolicy;
use App\FavouriteProduct;
use App\ProductReview;
use App\Review;
use App\City;
use App\FavouriteBusiness;
use App\MobileUser_BusinessCategory;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Searchable\Search;



class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::where('visible',1)->get();
        $last_products=Product::orderBy('created_at','DESC')->take(10)->get();
        $offers=Product::where('is_offer',Product::is_offer)->orderBy('created_at','DESC')->take(10)->get();
        $preferred_businesses=PreferredBusiness::get();


        $all_products=Product::paginate(30);
        $banner_data=array();
        $business_data=array();

         foreach ($banners as $banner) {
                $object = [
                    'id' => $banner->id,
                    'text'=>$banner->text,
                    'image' => is_null($banner->image) ? '' : $banner->image,
                    'type'=>is_null($banner->type) ? '' :$banner->type,
                    'link'=>is_null($banner->type_id) ? '' : $banner->type_id
                ];
                array_push($banner_data, $object);
         }

        foreach ($preferred_businesses as $business) {
            $object = [
                'id' => $business->product_id,
                'name'=>BusinessInfo::where('user_id',$business->product_id)->value('business_name'),
                'image'=>BusinessInfo::where('user_id',$business->product_id)->value('image'),

            ];
            array_push($business_data, $object);
        }

        return response()->json([
            'error' => false,
            'message' => 'Success',
            'banners' => $banner_data,
            'last_products' => $this->generate_data($last_products),
            'offers' => $this->generate_data($offers),
            'all_products' =>  $this->generate_data($all_products),
            'preferred_businesses'=>$business_data
        ], 200);



    }


    public function all_products(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $count_products=Product::where('visible',Product::visible)->count();
        $paginations=$count_products/30;
        $limit=30;

        $all_products = Product::where('visible',Product::visible)->limit($limit)->offset(($page - 1) * $limit)->get();

        return response()->json([
            'error' => false,
            'message' => 'Success',
            'paginations'=>(int)$paginations,
            'all_products' => $this->generate_data($all_products)
        ], 200);


    }

    public function generate_data($products)
    {
        $products_data=array();
        foreach ($products as $product) {
            $obj = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => floatval($product->price),
                'is_offer'=> $product->is_offer=='1' ? true :false,
                'discount' =>$product->is_offer=='1' ? $product->discount :0,
                'description' => $product->description,
                'favourite'=> FavouriteProduct::where('product_id',$product->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
                'business_id'=>$product->business_id,
                'business_name'=>$product->business->business_name

            ];
            array_push($products_data, $obj);
        }

        return $products_data;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy_policy()
    {
        $privacy=PrivacyPolicy::first();
        if($privacy){
            return response()->json([
                'error' => false,
                'message' => 'Success',
                'data' => $privacy->text,
            ], 200);
        }

        else{
            return response()->json([
                'error' => false,
                'message' => 'No Data',
            ], 200);
        }

    }

    public function coupons(){

        $coupon_types=CouponType::where('visible',CouponType::visible)->get();
        $data = array(); $data_coupons=array();

        if($coupon_types) {
            foreach ($coupon_types as $type) {
                $coupons = Coupon::where('type' , $type->id)->get();
                foreach ($coupons as $coupon) {
                    $obj = [
                        'id' => $coupon->id,
                        'name' => $coupon->name,
                        'code' => $coupon->code,
                        'discount' => $coupon->discount,
                        'start_date' => $coupon->start_date,
                        'end_date' => $coupon->end_date,
                    ];
                    array_push($data_coupons, $obj);
                }

                $object = [
                    'type_id' => $type->id,
                    'name' => $type->name,
                    'products' => $data_coupons
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


    public function global_search(Request $request)
    {
        $string=$request->text; $data_products=array(); $data_categories=array(); $data_businesses=array();

        $searchProduct = Product::where('name','LIKE','%'.$string.'%')->where('visible',1)->take(100)->get();

        foreach ($searchProduct as $product) {
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
                'business_name'=>$product->business->business_name,

            ];
            array_push($data_products, $obj);
        }


//        $searchCategory = (new Search())
//            ->registerModel(BusinessCategory::class, 'name')
//            ->perform($string);

        $searchCategory = BusinessCategory::where('name','LIKE','%'.$string.'%')->where('visible',1)->get();

        foreach ($searchCategory as $category) {
            $object = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image,
                'favourite'=> MobileUser_BusinessCategory::where('business_category_id',$category->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,

            ];
            array_push($data_categories, $object);
        }

//        $searchBusiness = (new Search())
//            ->registerModel(BusinessInfo::class, 'business_name')
//            ->perform($string);

        $searchBusiness = BusinessInfo::where('business_name','LIKE','%'.$string.'%')->get();
        foreach ($searchBusiness as $business)
        {
            $now_time=date('H:i:s');
            //checking if today is weekday or weekend
            if($this->isWeekend(date('Y-m-d'))){
                if($now_time > $business->weekend_open and $now_time < $business->weekend_close) {
                    $status='open';
                } else{
                    $status='closed';
                }
            }
            else{
                if($now_time > $business->open and $now_time < $business->close) {
                    $status='open';
                } else{
                    $status='closed';
                }
            }

            $ratings=number_format(Review::where('business_id',$business->user_id)->avg('review'), 2, '.', ',');
            $nr=number_format(Review::where('business_id',$business->user_id)->count('id'));

            $object = [
                'id' => $business->user_id,
                'name' => $business->business_name,
                'image' => $business->image,
                'city'=>City::find($business->city_id)->name,
                'status'=>$status,
                'delivery'=>is_null($business->delivery_price) ? '' : $business->delivery_price,
                'ratings'=>$ratings,
                'rated'=>$nr,
                'favourite'=> FavouriteBusiness::where('business_id',$business->user_id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
            ];
            array_push($data_businesses, $object);
        }


        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
                'products' => $data_products,
                'businesses' => $data_businesses,
                'categories' => $data_categories,
            ],200
        );

    }


    function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
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
        //
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
