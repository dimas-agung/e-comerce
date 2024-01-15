<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
                'token' =>  $user->remember_token,
                'data' => $user
            ],200);
        }else{
            return response()->json([
                'message' => 'Username atau Password Tidak Ditemukan!'
            ],401);
        }

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
