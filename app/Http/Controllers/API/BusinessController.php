<?php

namespace App\Http\Controllers\API;

use App\BusinessCategory;
use App\BusinessInfo;
use App\FavouriteBusiness;
use App\FavouriteProduct;
use App\ProductReview;
use App\BusinessImage;
use App\City;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index($id){

        $business=BusinessInfo::where('user_id',$id)->first();
        $review_array=array(); $image_array=array();
        if($business){
              $reviews=Review::where('business_id',$id)->get();
              $images=BusinessImage::where('business_id',$id)->get();
                foreach ($reviews as $review){
                    $object1=[
                        'id'=>$review->id,
                        'user'=>$review->mobile_user->name,
                        'rating'=>$review->review,
                        'comment'=>is_null($review->comment)?'':$review->comment,
                    ];
                    array_push($review_array,$object1);
                }
            foreach ($images as $image){
                $objecti=[
                    'id'=>$image->id,
                    'image'=>$image->image
                ];
                array_push($image_array,$objecti);
            }
                $object=[
                    'id' => $business->user_id,
                    'name' => $business->business_name,
                    'description' => is_null($business->description) ? '' : $business->description,
                    'image' => $business->image,
                    'banner' => is_null($business->banner) ? '' : $business->banner,
                    'nuis' => $business->nuis,
                    'address' => $business->address,
                    'category'=>BusinessCategory::find($business->business_category_id)->name,
                    'city' => $business->city->name,
                    'delivery'=>is_null($business->delivery_price) ? '' : $business->delivery_price,
                    'open_hours_weekday'=>$business->open .'-' .$business->close,
                    'open_hours_weekend'=>$business->weekend_open .'-' .$business->weekend_close,
                    'favourite'=> FavouriteBusiness::where('business_id',$business->user_id)->where('mobile_user_id',Auth::id())->exists() ? true : false,
                    'multiple_images'=>$image_array,
                    'reviews'=>$review_array


                ];
                return response()->json(
                    [
                        'error' => false,
                        'message' => 'Success',
                        'data' => $object
                    ],200
                );
        } else{
            return response()->json(
                [
                    'error' => false,
                    'message' => 'No details found',
                    'data' => array()

                ],404
            );
        }
    }

    public function  leave_review(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'review' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }
        $review= new Review();
        $review->mobile_user_id = Auth::id();
        $review->business_id = $id;
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


    public function store_favourite_business(Request $request){

        $validator = Validator::make($request->all(), [
            'business_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        if(FavouriteBusiness::where('business_id',$request->business_id)->where('mobile_user_id',Auth::id())->exists()){
            return response()->json(
                [
                    'error' => true,
                    'message' => 'You are not allowed to do this action',
                ],403
            );
        }

        $business=new FavouriteBusiness();
        $business->mobile_user_id=Auth::id();
        $business->business_id=$request->business_id;
        if($business->save()) {
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

    function isWeekend($date)
    {
        return (date('N', strtotime($date)) >= 6);
    }

    public function get_favourite_business()
    {
        $data=array();
        $businesses = FavouriteBusiness::join('business_infos','favourite_businesses.business_id','business_infos.user_id')
            ->where('mobile_user_id', Auth::id())->get();

        foreach ($businesses as $business) {
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
        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
                'data' => $data
            ],200
        );
    }

    public function delete_favourite_business($id){
        FavouriteBusiness::where('mobile_user_id', Auth::id())->where('business_id',$id)->forceDelete();
        return response()->json(
            [
                'error' => false,
                'message' => 'Success',
            ],200
        );
    }


}
