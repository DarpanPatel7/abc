<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileTrait {

	/**
     * Does very basic image,video,audio path building , uploading , deleting
     * First check if its available on s3
     * if not, check on local
     * if not, pass blank
     * @param object
     * @return array
     * created by Darpan, 26 May 2022
     */

    public function UploadFile($path,$file){
        //upload file 
        $fileName = time().rand(10000,99999).$file->getClientOriginalName();  

        //create directory if not exist
        if(!Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->makeDirectory($path);
        }

        if(Storage::disk('uploads')->put($path.'/'.$fileName, file_get_contents($file))){
            return $path.'/'.$fileName;
        }else{
            return false;
        }

    }

    public function DeleteFile($path){
        if(Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->delete($path);
        }

        //delete thumb file is any
        $width = 100;
        $height = 100;
        $extension = \File::extension(Storage::disk('uploads')->url($path));
        $file_new = '/_thumb/' . mb_substr($path, 0, mb_strrpos($path, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
        if(Storage::disk('uploads')->exists($file_new)) {
            Storage::disk('uploads')->delete($file_new);
        }
    }

}
