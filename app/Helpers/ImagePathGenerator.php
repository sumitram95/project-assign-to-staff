<?php
namespace App\Helpers;
class ImagePathGenerator {
    public static function getImagePath($imagePath){
        return asset('/storage/uploads/' . $imagePath);
    }
}
