<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageManager
{
    private $sizes = [
        'big' => '500x400',
        'medium' => '400x300',
        'small' => '300x200',
        'mini' => '128x128'
    ];

    public function processImage($path, $image, $name)
    {
        foreach ($this->sizes as $key => $value) {
            $size = $key;
            $dimens = explode('x', $value);
            $file = Image::make($image)->fit($dimens[0], $dimens[1], function ($constraint) {
                $constraint->upsize();
            });
            $this->saveImage($path, $size, $name, $file);
        }
    }

    private function saveImage($path, $size, $name, $file)
    {
        return Storage::disk('public')->put("{$path}/{$size}/{$name}", $file->encode());
    }

    public function deleteImages($path, $name)
    {
        foreach ($this->sizes as $key => $value) {
            $size = $key;
            Storage::disk('public')->delete("{$path}/{$size}/{$name}");
        }
    }
}
