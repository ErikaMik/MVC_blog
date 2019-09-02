<?php

namespace App\Helper;

use Intervention\Image\ImageManager;

class ImageHelper
{
    public static function imageSave($image)
    {
        $image = basename($_FILES["resume"]["name"]);
        $imagearray = str_split($image);
        $dir1 = $imagearray[0];
        $dir2 = $imagearray[1];
        $dir3 = $imagearray[2];

        $targetDirectory = "/var/www/html/php2/mvc/uploads/";

        if(file_exists($targetDirectory.$dir1.'/'.$dir2.'/'.$dir3.'/'.$image)){
            echo "File $image already exists";
        }else{
            $dir = $targetDirectory.$dir1.'/'.$dir2.'/'.$dir3.'/';
            if(!file_exists($dir)){
                mkdir($dir, 755, true);
            };
            move_uploaded_file($_FILES["post_img"]["tmp_name"], $dir.$image);
            echo "Upload succesfull - $dir";
        }

        //$manager = new ImageManager(array('driver' => 'imagick'));
        //$image = $manager->make($targetfile)->resize(300, 200);
        //$image->save('/var/www/html/php2/mvc/uploads/300x200'.$_FILES["post_img"]["name"], 100);
    }

    public static function loadImage($image)
    {
        $imagearray = str_split($image);
        $dir1 = $imagearray[0];
        $dir2 = $imagearray[1];
        $dir3 = $imagearray[2];

        $targetDirectory = "/var/www/html/php2/mvc/uploads/";
        if(file_exists($targetDirectory.$dir1.'/'.$dir2.'/'.$dir3.'/'.$image)){
            $img = $dir1.'/'.$dir2.'/'.$dir3.'/'.$image;
            return $img;
        }
    }

    public static function resizeImage($image, $w, $h)
    {
        $cropImage = '/var/www/html/php2/mvc/uploads/cache/'.ImageHelper::imageDir($image).$w.'x'.$h.'/'.$image;

        if(!file_exists($cropImage)){
            $manager = new ImageManager(array('driver' => 'imagick'));
            $image = $manager->make($image)->resize($w, $h);
            $image->save('/var/www/html/php2/mvc/uploads/cache/'.ImageHelper::imageDir($image).$w.'x'.$h.'/'.$image, 100);
        }
        $cropImage = ImageHelper::imageDir($image).$w.'x'.$h.'/'.$image;

        return $cropImage;


        //$manager = new ImageManager(array('driver' => 'imagick'));
        //$image = $manager->make($image)->resize($w, $h);
        //$image->save('/var/www/html/php2/mvc/uploads/cache/'
        //    .ImageHelper::imageDir($image).$w.'x'.$h.$_FILES["post_img"]["name"], 100);
    }

    public static function imageDir($image)
    {
        $imagearray = str_split($image);
        $dir1 = $imagearray[0];
        $dir2 = $imagearray[1];
        $dir3 = $imagearray[2];

        $dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
        return $dir;
    }


}