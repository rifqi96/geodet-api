<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeoLocation;

class GeoLocationController extends Controller
{
    public function index(){
        return response([
            'status' => 200,
            'code' => 1,
            'data' => GeoLocation::all()
        ]);
    }

    public function show($ipaddress){
        $data = GeoLocation::where('ipaddress', $ipaddress)->get();
        return response([
            'status' => 200,
            'code' => 1,
            'data' => $data
        ]);
    }

    public function doAdd(Request $request){
        $validator = $this->getValidationFactory()->make($request->all(), [
            'ipaddress' => 'required|ip',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            abort(412, $validator->messages());
        }

        $new_geo = new GeoLocation();

        if(!$new_geo->doAdd($request)){
            abort(400,"Failed to add geolocation");
        }

        return response([
            'status' => 200,
            'code' => 1,
            'message' => 'Succeed'
        ]);
    }
}
