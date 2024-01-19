<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    function index(Request $request){
        $users_id = $request->input('users_id');
        $address_id = $request->input('address_id');
      
        if ($users_id) {
            # code...
            $address= Address::with(['district.city.province'])->where('users_id',$users_id)->latest()->get();

        }elseif ($address_id) {
            # code...
            $address= Address::with(['district.city.province'])->where('id',$address_id)->latest()->first();
           
        }else{
            $address= Address::with(['district.city.province'])->latest()->get();
        }
        
        return $address;
    }
    public function store(Request $request)
    {
        //
        // return 123;
        $validated = $request->validate([
            'fullname' => ['required'],
            'users_id' => ['required'],
            'is_default' => ['required'],
            'phone_number' => ['required'],
            'districts_id' => ['required'],
            'village' => ['required'],
            'address' => ['required'],
            'postal_code' => ['required'],
            'label' => ['sometimes', 'nullable'],
        ]);
        $district = District::with('city.province')->where('id',$request->input('districts_id'))->orderBy('name')->first();
        // return $request->input('postal_code');
        if ( $request->input('is_default') == 1) {
            Address::where('users_id',$request->input('users_id'))->udpate([
                'is_default' => 0,
            ]);
        }
        $address = Address::create([
            'label' => $request->input('label'),
            'fullname' => $request->input('fullname'),
            'users_id' => $request->input('users_id'),
            'is_default' => $request->input('is_default'),
            'districts_id' => $request->input('districts_id'),
            'cities_id' => $district->city->id,
            'provinces_id' => $district->city->province->id,
            'village' => $request->input('village'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
        ]);
        // $address = Address::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Data Address berhasil diproses.',
            'data' => $address,
        ], 201); 
    }

    public function update(Request $request, Address $address)
    {
        //
        $validated = $request->validate([
            'fullname' => ['required'],
            'users_id' => ['required'],
            'is_default' => ['required'],
            'phone_number' => ['required'],
            'districts_id' => ['required'],
            'village' => ['required'],
            'address' => ['required'],
            'postal_code' => ['required'],
            'label' => ['sometimes', 'nullable'],
        ]);
        $district = District::with('city.province')->where('id',$request->input('districts_id'))->orderBy('name')->first();
        // return $request->input('postal_code');
        if ( $request->input('is_default') == 1) {
            Address::where('users_id',$request->input('users_id'))->udpate([
                'is_default' => 0,
            ]);
        }
        $address = $address->update([
            'label' => $request->input('label'),
            'fullname' => $request->input('fullname'),
            'users_id' => $request->input('users_id'),
            'is_default' => $request->input('is_default'),
            'districts_id' => $request->input('districts_id'),
            'cities_id' => $district->city->id,
            'provinces_id' => $district->city->province->id,
            'village' => $request->input('village'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Data Address berhasil diproses.',
            'data' => $address,
        ], 201); 
    }

}
