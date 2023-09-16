<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait ImageTrait {

	/**
     * Does very basic image,video,audio path building , uploading , deleting
     * First check if its available on s3
     * if not, check on local
     * if not, pass blank
     * @param object
     * @return array
     * created by Darpan, 11 Oct 2021
     */

    public function ValidateBase64Image($string){            
        $mime_type = '' ;

        if(strpos($string, ';') !== false) {
            list($type, $file) = explode(';', $string);
            list($type, $mime_type) = explode(':', $type);
        }

        $MIME_TYPE_ALLOWED = array(
            'image/jpeg',
            'image/png',
            'image/jpg',
            'image/svg'
        );

        if(!in_array($mime_type, $MIME_TYPE_ALLOWED,true)) {
            return false;
        } else{
            return true;
        }
    }

    public function UploadImage($path,$image){
        //upload image 
        $imageName = time().rand(10000,99999).$image->getClientOriginalName();  

        //create directory if not exist
        if(!Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->makeDirectory($path);
        }

        if(Storage::disk('uploads')->put($path.'/'.$imageName, file_get_contents($image))){
            return $path.'/'.$imageName;
        }else{
            return false;
        }

    }
    
    public function UploadBase64Image($path,$base64){
        list($type, $base64) = explode(';', $base64);
        list($type, $ext) = explode('/', $type);
        list(, $base64) = explode(',', $base64);
        $base64 = base64_decode($base64);
        $image_name= time().rand(10000,99999).'.'.$ext;
        
        //create directory if not exist
        if(!Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->makeDirectory($path);
        }
        
        if(Storage::disk('uploads')->put($path.'/'.$image_name, $base64)){
            return $path.'/'.$image_name;
        }else{
            return false;
        }
    }

    public function DeleteImage($path){
        if(Storage::disk('uploads')->exists($path)) {
            Storage::disk('uploads')->delete($path);
        }
    }

    public function resizeImage($filename, $width, $height) {
        if (!Storage::disk('uploads')->exists($filename)) {
            return;
        }

        $extension = \File::extension(Storage::disk('uploads')->url($filename));

        $image_old = $filename;
        $image_new = '/_thumb/' . mb_substr($filename, 0, mb_strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;
        
        if (!Storage::disk('uploads')->exists($image_new) || (Storage::disk('uploads')->lastModified($image_new) > Storage::disk('uploads')->lastModified($image_old))) {
            list($width_orig, $height_orig, $image_type) = getimagesize(Storage::disk('uploads')->url($image_old));
            
            $path = '';

            $directories = explode('/', dirname($image_new));

            foreach ($directories as $directory) {
                $path = $path . '/' . $directory;                
                //echo Storage::disk('uploads')->path('');
                File::ensureDirectoryExists(Storage::disk('uploads')->path('').$path);
                
            }
            if ($width_orig != $width || $height_orig != $height) {
                ImageTrait::resize(Storage::disk('uploads')->path('') . $image_old, $width, $height, '', Storage::disk('uploads')->path('') . $image_new);
            } else {
                copy(Storage::disk('uploads')->path('') . $image_old, Storage::disk('uploads')->path('') . $image_new);
            }
        }

        return Storage::disk('uploads')->url($image_new);

    }

    public function resize( $file, $width = 0, $height = 0, $default = '', $file_new) {
    

        if (file_exists($file)) {
            
            $info = getimagesize($file);

            $file_width  = $info[0];
            $file_height = $info[1];
            $file_bits = isset($info['bits']) ? $info['bits'] : '';
            $file_mime = isset($info['mime']) ? $info['mime'] : '';

            if ($file_mime == 'image/gif') {
                $image = imagecreatefromgif($file);
            } elseif ($file_mime == 'image/png') {
                $image = imagecreatefrompng($file);
            } elseif ($file_mime == 'image/jpeg') {
                $image = imagecreatefromjpeg($file);
            } elseif ($file_mime == 'image/webp') {
                $image = imagecreatefromwebp($file);
            }
        } else {
            exit('Error: Could not load image ' . $file . '!');
        }

        $xpos = 0;
        $ypos = 0;
        $scale = 1;

        $scale_w = $width / $file_width;
        $scale_h = $height / $file_height;

        if ($default == 'w') {
            $scale = $scale_w;
        } elseif ($default == 'h') {
            $scale = $scale_h;
        } else {
            $scale = min($scale_w, $scale_h);
        }

        if ($scale == 1 && $scale_h == $scale_w && $file_mime != 'image/png') {
            return;
        }

        $new_width = (int)($file_width * $scale);
        $new_height = (int)($file_height * $scale);
        $xpos = (int)(($width - $new_width) / 2);
        $ypos = (int)(($height - $new_height) / 2);

        $image_old = $image;
        $image = imagecreatetruecolor($width, $height);

        if ($file_mime == 'image/png') {
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $background = imagecolorallocatealpha($image, 255, 255, 255, 127);
            imagecolortransparent($image, $background);
        } else {
            $background = imagecolorallocate($image, 255, 255, 255);
        }

        imagefilledrectangle($image, 0, 0, $width, $height, $background);

        imagecopyresampled($image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $file_width, $file_height);
        imagedestroy($image_old);

        $file_width = $width;
        $file_height = $height;

        $info_new = pathinfo($file_new);
        $extension_new = strtolower($info_new['extension']);

        if ($extension_new == 'jpeg' || $extension_new == 'jpg') {
            imagejpeg($image, $file_new, 100);
        } elseif ($extension_new == 'png') {
            imagepng($image, $file_new);
        } elseif ($extension_new == 'gif') {
            imagegif($image, $file_new);
        } else { 
            imagegif($image, $file_new);
        }

        imagedestroy($image);

    }

}
