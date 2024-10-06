<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait HandleImageTrait
{
    protected $path = 'upload/products';
    public function veryfy($request)
    {
        return $request->has('img');
    }

    public function saveImage($request)
    {
        if ($this->veryfy($request)) {

            $image = $request->file('img');
            $originalName = $image->getClientOriginalName();
            $name = time() . '_' . $originalName;
            $image->move(public_path('upload/products'), $name);
            return $name;
        }
    }

    public function updateImage($request, $currentImage)
    {
        if ($this->veryfy($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }

    public function deleteImage($imageName)
    {
        if (file_exists(public_path($this->path . $imageName))) {
            unlink($this->path . $imageName);
        }
    }
}
