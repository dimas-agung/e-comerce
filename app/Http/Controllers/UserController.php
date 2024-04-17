<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cities;
use App\Models\District;
use App\Models\Provinces;
use App\Models\User;
use App\Models\Village;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserService $userService;
    public function __construct() {
        $this->userService =  new UserService();
        // $this->middleware('auth');
    }
    //
    public function index()
    {
        // $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        // //


        $users = User::latest()->get();
        // $provinces = Provinces::orderBy('name')->get();
        // $cities = Cities::orderBy('name')->get();
        $district = District::with('city.province')->orderBy('name')->get();
        // return $district;
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.index', [
            'users' => $users,
            // 'provinces' => $provinces,
            // 'cities' => $cities,
            'district' => $district,
        ]);
    }
    public function store(Request $request)
    {
        //
        DB::beginTransaction();
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
        return redirect('user')->with('success', 'Data User has been created!');
    }
    public function show(User $user)
    {
        $district = District::with('city.province')->orderBy('name')->get();
        // return $district;
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.edit', [
            'user' => $user,
            'districts' => $district,
        ]);
    }
    public function edit(User $user)
    {

        $district = District::orderBy('name')->get();
        $address = Address::with('district.city.province')->where('users_id',$user->id)->get();
        // return $address;
        // $users = User::orderBy('name')->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.edit', [
            'user' => $user,
            'districts' => $district,
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
    public function change_password(Request $request,User $user)  {
        $email = $request->input('email');
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        // return $newPassword;
        $response = $this->userService->change_password_admin($oldPassword,$newPassword);
        if (!$response){
            // return 'Username / Password Salah!';
            return redirect()->back()->with('error', 'Username / Password Salah!');
            
        }
        // return 'success';
        return redirect()->back()->with('success', 'Pasword User berhasil di ubah');
    }

}