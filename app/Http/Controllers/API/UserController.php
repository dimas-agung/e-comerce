<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function index(Request $request){
        $remember_token = $request->input('token');

        $user= User::with('address')->where('remember_token',$remember_token)->first();
        if($user){
            return response()->json([
                'success' => true,
                'message' => 'Data User ditemukan.',
                'data' => $user,
            ], 201);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data User tidak ditemukan.',
            'data' => null,
        ], 404);
    }
    public function store(Request $request)
    {
        //
        // return 123;
        DB::beginTransaction();
        // return $request->input('cities_id');
        $validated = $request->validate([
            'fullname' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'password' => ['required'],
            'birth_date' => ['sometimes', 'nullable'],
        ]);
        // return 123;
        $user = User::create($validated);
        $password = Hash::make($request->input('password'));
        $user->update(['password'=> $password]);
        $district = District::with('city.province')->where('id',$request->input('districts_id'))->orderBy('name')->first();
        // return $request->input('postal_code');
        $address = Address::create([
            'fullname' => $user->fullname,
            'users_id' => $user->id,
            'phone_number' => $user->phone_number,
            'is_default' => 1,
            'label' => 'Rumah',
            'districts_id' => $request->input('districts_id'),
            'cities_id' => $district->city->id,
            'provinces_id' => $district->city->province->id,
            'village' => $request->input('village'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
        ]);
        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Data User berhasil di simpan.',
            'data' => $user,
            'token' =>  $user->remember_token,
        ], 404);
    }
}
