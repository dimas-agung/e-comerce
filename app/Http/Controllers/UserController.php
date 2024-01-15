<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cities;
use App\Models\District;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        // $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        // //
        

        $users = User::latest()->get();
        $provinces = Provinces::orderBy('name')->get();
        $cities = Cities::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $villages = Village::orderBy('name')->get();
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.index', [
            'users' => $users,
            'provinces' => $provinces,
            'cities' => $cities,
            'district' => $district,
            'villages' => $villages,
        ]);
    }
    public function store(Request $request)
    {
        //
        // return $request->input('cities_id');
        $validated = $request->validate([
            'fullname' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'roles_id' => ['required'],
            'password' => ['required'],
            'birth_date' => ['sometimes', 'nullable'],

        ]);
        $user = User::create($validated);
        $password = Hash::make($request->input('password'));
        $user->update(['password'=> $password]);
        $address = Address::create([
            'fullname' => $user->fullname,
            'users_id' => $user->id,
            'phone_number' => $user->phone_number,
            'provinces_id' => $request->input('provinces_id'),
            'districts_id' => $request->input('districts_id'),
            'cities_id' => $request->input('cities_id'),
            'villages_id' => $request->input('villages_id'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
        ]);
        return redirect('user')->with('success', 'Data User has been created!');
    }
    public function show(User $user)
    {
        $provinces = Provinces::orderBy('name')->get();
        $cities = Cities::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.edit', [
            'user' => $user,
            'provinces' => $provinces,
            'cities' => $cities,
            'district' => $district,
        ]);
    }
    public function edit(User $user)
    {
        $provinces = Provinces::orderBy('name')->get();
        $cities = Cities::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $address = Address::where('users_id',$user->id)->get();
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.edit', [
            'user' => $user,
            'provinces' => $provinces,
            'cities' => $cities,
            'district' => $district,
            'address' => $address,
        ]);
    }
    public function update(Request $request, User $user)
    {
        //
        // return $user;
        $validated = $request->validate([
            'fullname' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'roles_id' => ['required'],
            // 'password' => ['required'],
            'birth_date' => ['sometimes', 'nullable']
        ]);
        $user->update($validated);
        // return $user;
        return redirect('user/'.$user->id.'/edit')->with('success', 'Data User been updated!');
    }
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect('user')->with('success', 'Data User has been deleted!');
    }
}
