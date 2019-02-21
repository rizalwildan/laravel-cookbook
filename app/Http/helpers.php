<?php
/**
 * Created by PhpStorm.
 * User: rzlxbot
 * Date: 2/20/19
 * Time: 8:23 PM
 */
use Illuminate\Support\Facades\Storage;
use App\Models\Categories;

if (!function_exists('imageUpload')) {
    function imageUpload($img, $dir) {
        $path = $img->hashName('public/img/'.$dir);

        $image = \Image::make($img);

        Storage::put($path, (string) $image->encode());

        return $img->hashName();
    }
}

if (!function_exists('getImage')) {
    function getImage($dir='null', $img='null')
    {
        $link = (Storage::exists('public/img/'.$dir.'/'.$img) && $img != null ) ? asset('storage/img/'.$dir.'/'.$img) : 'https://via.placeholder.com/150';
        return $link;
    }
}

if (!function_exists('getCategories')) {
    function getCategories()
    {
        $categories = Categories::all();
        return $categories;
    }
}
