<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    function login(Request $request){
        // $user = Auth::user();
        // return $user;
        $login = Auth::Attempt($request->all());
        // return $login;
        if ($login) {
            $user = Auth::user();
            $user->remember_token = Str::random(50);
            $user->save();
            // $user->makeVisible('api_token');

            return response()->json([
                'message' => 'Login Berhasil',
                'success' => true,
                'token' =>  $user->remember_token,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Username atau Password Tidak Ditemukan!'
            ],401);
        }

    }
    function getUser(Request $request){
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
            'success' => false,
            'message' => 'Data User tidak ditemukan.',
            'data' => null,
        ], 404);
    }
    //
    function logout(Request $request){

        $login = Auth::Attempt($request->all());
        // return $login;
        if ($login) {
            $user = Auth::user();
            $user->remember_token = Str::random(50);
            $user->save();
            // $user->makeVisible('api_token');

            return response()->json([
                'message' => 'Login Berhasil',
                'token' =>  $user->remember_token,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'message' => 'Username atau Password Tidak Ditemukan!'
            ],401);
        }

    }
}
