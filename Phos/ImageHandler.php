<?php
namespace Phos;

use Image;

/**
 * Handling Image Upload
 */
class ImageHandler
{

  public function process($image)
  {    
    $ext = $image->getClientOriginalExtension();
    $img = Image::make($image);

    $filename = str_random(20);
    $path = public_path('logos/'.$filename.'.'.$ext);
    $img->resize(400, 400, function ($constraint) {
      $constraint->aspectRatio();
    });

    $img->save($path);
    return env('URL').'/logos/'.$filename.'.'.$ext;
  }

}
