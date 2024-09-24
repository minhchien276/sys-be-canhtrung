<?php

namespace App\Services\AWSS3;

use Illuminate\Support\Facades\Storage;

class deleteImage
{
    public function handle($oldAvatar)
    {
        // Lấy đường dẫn tương đối của avatar cũ từ URL
        $oldAvatarPath = parse_url($oldAvatar, PHP_URL_PATH);
        // Xóa file cũ từ S3
        Storage::disk('s3')->delete($oldAvatarPath);
    }
}
