<?php

namespace App\Services\AWSS3;

use Illuminate\Support\Facades\Storage;

class uploadImage
{
    public function handle($request, $link)
    {
        $path = $request->file('image')->store($link, 's3');
        $url = Storage::disk('s3')->url($path);

        return $url;
    }
}
