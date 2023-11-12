<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cities;
use App\Models\District;
use App\Models\Provinces;
use App\Models\User;
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
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.index', [
            'users' => $users,
            'provinces' => $provinces,
            'cities' => $cities,
            'district' => $district,
        ]);
    }
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'fullname' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'roles_id' => ['required'],
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
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $user->update($validated);
        return redirect('product_category')->with('success', 'Data Product Category has been updated!');
    }
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect('user')->with('success', 'Data User has been deleted!');
    }
}
