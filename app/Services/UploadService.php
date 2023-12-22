<?php
namespace App\Services;

use App\Models\Order;

use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadService
{
    function upploadFile($file,$path,$file_name){
       
    
        $image = Image::make($file->getRealPath());
        $image->encode('jpg', 90); 
        // $image->resize(320, 240); 
        $file_compressed = $image;

        $fullPath = "{$path}/{$file_name}";
        // $img = Image::make('public/foo.jpg')->resize(320, 240)->insert('public/{$path}/{$file_name}');
        Storage::disk('public')->put($fullPath, $file_compressed);
        // $files->storePubliclyAs($path, $file_name, "public");
        $url = $path.'/'. $file_name;
        return $url;
    }
}