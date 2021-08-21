<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController
{   
    public function index(Request $request)
    {   
        $file = $request->all();
        
        $fullPath = 'public/temp/' . Str::random(10).'.'.'png';

        if ($file['cropped_image'][0]->path()) {
            $file = $file['cropped_image'][0]->path();
            $fileBase64 = base64_encode(file_get_contents($file));
            $filePath = Storage::disk('local')->put($fullPath, base64_decode($fileBase64));

        } else{
            $file       = $request->file('file');
            $filePath   = Storage::disk('local')->put($fullPath, $file);
        }
        

        return json_encode($fullPath);
    }

}
