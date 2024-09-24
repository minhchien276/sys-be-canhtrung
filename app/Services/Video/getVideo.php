<?php
namespace App\Services\Video;

use App\Models\video;

class getVideo
{
    public function handle()
    {
        $video = video::get();

        return $video;
    }
}