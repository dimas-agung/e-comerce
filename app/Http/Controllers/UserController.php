<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        // $pictures = [UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg'),UploadedFile::fake()->create('file.jpg')];
        // //
        

        $users = User::latest()->get();
        // return $product;
        // return $product[0]->varians;
        return response()->view('admin.user.index', [
            'users' => $users
        ]);
    }
}
