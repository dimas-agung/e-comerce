<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    private UserService $userService;
    public function __construct() {
        $this->userService =  new UserService();
        // $this->middleware('auth');
    }
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
            'is_default' => $request->input('is_default') ? $request->input('is_default'):0,
            'label' => $request->input('label') ? $request->input('label'):'Rumah',
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
        ], 200);
    }
    public function update(Request $request, User $user)
    {
        //
        // return $user;
        try {
            //code...
            $validated = $request->validate([
                'fullname' => ['required'],
                'username' => ['required'],
                'email' => ['required'],
                'phone_number' => ['required'],
                'birth_date' => ['sometimes', 'nullable']
            ]);
            $user->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Data User berhasil di ubah.',
                'data' => $user,
                'token' =>  $user->remember_token,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Data User gagal di ubah.',
                'data' => null,
            ], 404);
        }

    }
    public function change_password(Request $request)  {
        $email = $request->input('email');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $response = $this->userService->change_password($email,$oldPassword,$newPassword);
        if (!$response){
            return response()->json([
                'success' => false,
                'message' => 'Username / Password Salah.',
                'data' => null,
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Pasword User berhasil di ubah.',
            'data' => null,
        ], 200);
    }
}
