<?php

namespace App\ServicesAdmin\VideoAdmin;

use App\Models\video;

class IndexVideo
{
    public function index()
    {
        $video = video::get();

        return view('admin.video.index', compact('video'));
    }
}
