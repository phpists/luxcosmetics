<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Збереження зображень
     * @param $disk
     * @param $path
     * @param $image
     * @return bool|string
     */
    public static function saveImage($disk, $path, $image): bool|string
    {
        if ($image) {
            $imageName = time() . mt_rand(1, 9999) . '.' . $image->getClientOriginalExtension();
            $save = Storage::disk($disk)->putFileAs($path, $image, $imageName);
            if ($save) {
                return $imageName;
            }
        }
        return false;
    }

    public static function removeImage($disk, $path, $image){
        return Storage::disk($disk)->delete($path.'/'.$image);
    }
}

