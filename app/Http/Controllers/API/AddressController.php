<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\MobileUserAdress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = MobileUserAdress::where('mobile_user_id',Auth::id())->where('deleted','=',1)->get();
        $data = array();
        foreach ($addresses as $address) {
            $object = [
                'id' => $address->id,
                'lat' => $address->lat,
                'lng' => $address->lng,
                'city' => $address->city,
                'address' => $address->address,
                'description' => is_null($address->description) ? '' : $address->description,
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $address = new MobileUserAdress();
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->description = $request->description;
        $address->mobile_user_id = Auth::id();
        if ($address->save()) {
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
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true , 'message' => $validator->errors()->all()[0]]);
        }

        $address = MobileUserAdress::find($id);
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->description = $request->description;
        if ($address->save()) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_address($id)
    {
        $address = MobileUserAdress::find($id);
        if($address) {
            $address->deleted=0;
            if ($address->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'Address was deleted successfully',
                ],200);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'An error has occurred',

                ],404);
            }
        }
        else {
            return response()->json([
                'error' => true,
                'message' => 'Address not found',

            ],404);
        }
    }
}
