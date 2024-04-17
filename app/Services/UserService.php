<?php
namespace App\Services;

use App\Models\Order;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserService
{
    public function change_password($email,$oldPassword,$newPassword){
        if (Auth::attempt(['email' => $email, 'password' => $oldPassword])) {
            // Password lama benar, lanjutkan dengan mengubah password
            $user = Auth::user();
            $user->password = bcrypt($newPassword);
            $user->save();
            return true;
        }
        return false;
    }
    public function change_password_admin($oldPassword,$newPassword){
        
        $user = Auth::user();
        if (Auth::attempt(['email' => $user->email, 'password' => $oldPassword])) {
            // Password lama benar, lanjutkan dengan mengubah password
            $user->password = bcrypt($newPassword);
            $user->save();
            return true;
        }
        return false;
    }
}