<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\BusinessInfo;
use App\Http\Controllers\Controller;
use App\Order;
use App\Coupon;
use App\UsedCoupon;
use App\CartOrderItem;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class CartOrderItemController extends Controller
{


    public function order_shopping_cart(Request $request)
    {
        $user = Auth::id();
            $product = Product::find($request->product_id);
            $orderitem = new CartOrderItem();
            $orderitem->mobile_user_id = $user;
            $orderitem->business_id = $request->business_id;
            $orderitem->product_id = $request->product_id;
            $orderitem->name = $product->name;
            $orderitem->price = $request->price;
            $orderitem->quantity = $request->quantity;
            $orderitem->subtotal = (float)$request->price * (float)$request->quantity;
            $orderitem->save();

            return response()->json([
            'error' => false,
            'message' => 'Order was created succesfully',
             'item'=> [
                    'id'=>$orderitem->id,
                    'product_id'=>(int)$orderitem->product_id,
                    'business_id'=>(int)Product::find($orderitem->product_id)->business_id,
                    'name' => Product::find($orderitem->product_id)->name,
                    'image' => Product::find($orderitem->product_id)->image,
                    'price' => $orderitem->price,
                    'quantity' => $orderitem->quantity
                ]
            ], 200);
    }


    public function order_item_cart()
    {
        $all_items=CartOrderItem::where('mobile_user_id',Auth::id())->get();

        if($all_items) {
            return response()->json(
                [
                    'error' => false,
                    'all_items' => $this->order_item_details($all_items),
                ], 200
            );
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Empty Cart',
            ], 200);
        }


    }


    public function order_details($id){

        $items = OrderItem::where('order_id' , $id)->get();
        if($items) {
            return response()->json(
                [
                    'error' => false,
                    'items' => $this->order_item_details($items),
                ], 200
            );
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Empty',
            ], 200);
        }

    }

    public function order_item_details($items)
    {
        $data_items=array();
        foreach ($items as $item) {
            $obj = [
                'id'=>$item->id,
                'product_id'=>(int)$item->product_id,
                'business_id'=>(int)Product::find($item->product_id)->business_id,
                'name' => Product::find($item->product_id)->name,
                'image' => Product::find($item->product_id)->image,
                'price' => $item->price,
                'quantity' => $item->quantity
            ];
            array_push($data_items, $obj);
        }

        return $data_items;
    }

    public function remove_item($id)
    {
        $item=CartOrderItem::where('id',$id)->first();
        if($item) {
            $item->forceDelete();
            return response()->json([
                'error' => false,
                'message' => 'Deleted successfully',
            ], 200);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'No item exists',
            ], 200);
        }

    }

    public function increase($id)
    {
        $item=CartOrderItem::where('id',$id)->first();
        if($item) {
            $item->increment('quantity');
            return response()->json([
                'error' => false,
                'message' => 'Success',
            ], 200);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'No item exists',
            ], 200);
        }

    }


    public function decrease($id)
    {
        $item=CartOrderItem::where('id',$id)->first();
        if($item) {
            if($item->quantity > 0) {
                $item->decrement('quantity');
                return response()->json([
                    'error' => false,
                    'message' => 'Success',
                ], 200);
            }
            else{
                return response()->json([
                    'error' => true,
                    'message' => 'You can not decrease this item',
                ], 404);
            }
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'No item exists',
            ], 404);
        }

    }

    public function remove_all()
    {
        $items=CartOrderItem::where('mobile_user_id',Auth::id())->get();
        if($items) {
            $items->each->forceDelete();
            return response()->json([
                'error' => false,
                'message' => 'Deleted successfully',
            ], 200);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'No item exists',
            ], 200);
        }

    }



}
