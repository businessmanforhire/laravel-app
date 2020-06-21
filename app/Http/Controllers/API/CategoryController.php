<?php

namespace App\Http\Controllers\API;

use App\BusinessCategory;
use App\BusinessInfo;
use App\FavouriteBusiness;
use App\City;
use App\Http\Controllers\Controller;
use App\MobileUser_BusinessCategory;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = BusinessCategory::where('visible', \App\Category::visible)->get();

        $data = array();
        foreach ($categories as $category) {
            $object = [
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image,
                'favourite'=> MobileUser_BusinessCategory::where('business_category_id',$category->id)->where('mobile_user_id',Auth::id())->exists() ? true : false,

            ];
            array_push($data, $object);
        }


        $all_businesses = BusinessInfo::join('users', 'business_infos.user_id', '=', 'users.id')
            ->where('users.role', User::business)
            ->where('users.status', 1)
            ->get();



        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
                'data' => $data,
                'random_businesses' => $this->details($all_businesses),

            ], 200
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }

    public function show($id)
    {
        $business_rated = array();

        $all_businesses = BusinessInfo::join('users', 'business_infos.user_id', '=', 'users.id')
            ->where('business_infos.business_category_id', $id)
            ->where('users.status', 1)
            ->get();


        $new_businesses = BusinessInfo::join('users', 'business_infos.user_id', '=', 'users.id')
            ->where('business_infos.business_category_id', $id)
            ->where('users.status', 1)
            ->orderBy('business_infos.created_at', 'asc')
            ->take(5)
            ->get();


        $most_rated = BusinessInfo::join('users', 'business_infos.user_id', '=', 'users.id')->join('reviews', 'users.id', 'reviews.business_id')
            ->where('business_infos.business_category_id', $id)
            ->where('users.status', 1)
            ->select('reviews.business_id', DB::raw('avg(review) as avg_bus'))
            ->groupBy('reviews.business_id')
            ->orderBy('avg_bus', 'desc')
            ->take(10)
            ->get();


        if ($most_rated) {
            foreach ($most_rated as $item) {
                $business = BusinessInfo::where('user_id', $item->business_id)->first();
                $now_time = date('H:i:s');
                //checking if today is weekday or weekend
                if ($this->isWeekend(date('Y-m-d'))) {
                    if ($now_time > $business->weekend_open and $now_time < $business->weekend_close) {
                        $status = 'open';
                    } else {
                        $status = 'closed';
                    }
                } else {
                    if ($now_time > $business->open and $now_time < $business->close) {
                        $status = 'open';
                    } else {
                        $status = 'closed';
                    }
                }

                $ratings = number_format(Review::where('business_id', $business->user_id)->avg('review'), 2, '.', ',');
                $nr = number_format(Review::where('business_id', $business->user_id)->count('id'));

                $object = [
                    'id' => $business->user_id,
                    'name' => $business->business_name,
                    'image' => $business->image,
                    'city' => City::find($business->city_id)->name,
                    'status' => $status,
                    'delivery'=>is_null($business->delivery_price) ? '' : $business->delivery_price,
                    'ratings' => $ratings,
                    'rated' => $nr,
//                    'favourite'=> FavouriteBusiness::where('business_id',$business->user_id)->where('mobile_user_id',Auth::id())->exists() ? true : false,


                ];
                array_push($business_rated, $object);
            }
        }

        return response()->json(
                [
                    'error' => false,
                    'message' => 'Success',
                    'all_businesses' => $this->details($all_businesses),
                    'new_businesses' => $this->details($new_businesses),
                    'most_rated' => $business_rated
                ], 200
            );
    }






    public function details($businesses)
  {

    $data = array();

    foreach ($businesses as $business)
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
        array_push($data, $object);
        }
    return $data;
}


    public function choose_categories(Request $request){

        $validator = Validator::make($request->all(), [
            'categories' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', sprintf($validator->errors()->all()[0]));
        }

        $categories=$request->categories;
        $results =  explode(',', $categories);
        foreach ($results as $result){
            $rel=new MobileUser_BusinessCategory();
            $rel->mobile_user_id=Auth::id();
            $rel->business_category_id=$result;
            $rel->save();
            }
        return response()->json(
            [
                'error' => false,
                'message' => 'Categories were saved successfully',
            ], 200
        );
    }


    public function  get_favourite_categories(){

        $data_products=array();
        $categories = MobileUser_BusinessCategory::select('business_category_id')->where('mobile_user_id', Auth::id())->distinct()->get();
        foreach ($categories as $category) {
            $obj = [
                'id' => $category->business_category_id,
                'name' => BusinessCategory::find($category->business_category_id)->name,
                'image' => BusinessCategory::find($category->business_category_id)->image,
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


    public function delete_favourite_category($id){

        MobileUser_BusinessCategory::where('mobile_user_id', Auth::id())->where('business_category_id',$id)->forceDelete();
        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
            ],200
        );
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
