<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageUpload
{
    public function image_upload($file,$path){
                    list($width, $height) = getimagesize($file);
            $extension = $file->getClientOriginalExtension();
            $final_filename = $file->getFilename() . '.' . $extension;
            Storage::disk('public')->put($final_filename, File::get($file));
            $thumbs_real = Image::make($file->getRealPath());
            $thumbs_real->save(storage_path('app/public/images/'.$path.'') . '/' . $final_filename, 80);
            return $final_filename;

    }
}
