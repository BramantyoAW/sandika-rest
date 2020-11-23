<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\CustomerAddress;
use App\Http\Controllers\Controller;

class CustomerAddressController extends Controller 
{
    public function getCustomerAddressById($id)
    {
        $custAddrs = CustomerAddress::where('id', $id)->get();
               
        if (isset($custAddrs)) {
            $result = $custAddrs->toJson(JSON_PRETTY_PRINT);
            return response($result, 200);
        }else{
            $custAddrs = array(
                'message' => 'Address not found'
            );

            $result = $custAddrs->toJson(JSON_PRETTY_PRINT);
            return response($result, 404);
        }
    }

    public function newCustomerAddress(Request $request)
    {
        $address = new CustomerAddress;
        $address->kota = $request->kota;
        $address->kabupaten  = $request->kabupaten;
        $address->kecamatan  = $request->kecamatan;
        $address->kelurahan  = $request->kelurahan;
        $address->kode_pos  = $request->kode_pos;
        $address->longitude  = $request->longitude;
        $address->latitude  = $request->latitude;
        $address->save();

        return response()->json([
            "message" => "Address Saved"
          ], 201);
    }

    public function deleteCustomerAddress($id)
    {
        if(CustomerAddress::where('id', $id)->exists()) {
            $book = CustomerAddress::find($id);
            $book->delete();
    
            return response()->json([
              "message" => "Address deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Address not found"
            ], 404);
          }
    }

    public function updateCustomerAddress(Request $request, $id)
    {
        if (CustomerAddress::where('id', $id)->exists()) {
            $address = CustomerAddress::find($id);
            $address->kota = is_null($request->kota) ? $address->kota : $address->kota;
            $address->kabupaten = is_null($request->kabupaten) ? $address->kabupaten : $address->kabupaten;
            $address->save();

            // $address->kota = $request->kota;
            // $address->kabupaten  = $request->kabupaten;
            // $address->kecamatan  = $request->kecamatan;
            // $address->kelurahan  = $request->kelurahan;
            // $address->kode_pos  = $request->kode_pos;
            // $address->longitude  = $request->longitude;
            // $address->latitude  = $request->latitude;
    
            return response()->json([
              "message" => "address updated successfully"
            ], 200);
          } else {
            return response()->json([
              "message" => "address not found"
            ], 404);
          }
    }
}