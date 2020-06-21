<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class PostalController extends Controller
{

    const url ='https://postalbusiness.almotech.co/api/';

    public static function create_parcel($id,$bid)
    {
        $order=Order::find($id);


        $postal_fee=self::postal_fee($bid,$order->business->business_info->city_id);

        if($postal_fee==-1){
            self::reverse_status($id);
            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }


        $barcode=self::barcode($bid);

        if($barcode=="")
        {
            self::reverse_status($id);
            return redirect()->back()->with('error', sprintf('No active barcodes for your orders, please contact postal system support.'));

        }


        $client = new \GuzzleHttp\Client();
        $headers = [
            'Accept' => 'application/json',
        ];

        try {
            $response = $client->request('POST', self::url . 'store_parcel_api', [
                'headers' => $headers,
                'json' =>
                    [
                        'barcode'=>$barcode,
                        'receiver_name' => $order->mobile_users->name,
                        'receiver_phone' => $order->mobile_users->phone,
                        'receiver_address' =>$order->address->address,
                        'receiver_city' =>$order->business->business_info->city_id,
                        'receiver_email' => $order->mobile_users->email,
                        'note' => $order->note,
                        'type' => 'standart',
                        'postal_fee' => $postal_fee,
                        'delivery_payment' => $order->total,
                        'id' => $bid,
                    ]
            ]);
            

            $data = json_decode($response->getBody());


            return redirect()->back()->with('success', sprintf('Status was updated successfully'));

        } catch (BadResponseException $e) {

//            $response = $e->getResponse();

            self::reverse_status($id);

            return redirect()->back()->with('error', sprintf('An error occurred. Please try again later'));

        }

    }

    public static function postal_fee($id,$city){

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Accept' => 'application/json',
        ];

        try {
            $response = $client->request('POST', self::url . 'postal_fee_api', [
                'headers' => $headers,
                'json' =>
                    [
                        'receiver_city' => $city,
                        'type' => 'standart',
                        'id' => $id,
                    ]
            ]);

            $data = json_decode($response->getBody());
            $price = $data->postal_fee;

            return $price;


        } catch (BadResponseException $e) {

            return -1;
        }

    }


    public static function barcode($id)
    {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Accept' => 'application/json',
        ];


        try {
            $response = $client->request('GET', self::url . 'random_barcode_api/' . $id, [
                'headers' => $headers
            ]);


            $data = json_decode($response->getBody());

            $barcode = $data->barcode;

            return $barcode;

        } catch (BadResponseException $e) {

            return "";
        }
    }


    public static function reverse_status($id){
        $order=Order::find($id);
        $order->status='pending';
        $order->save();
    }
}
