<?php

namespace App\ServicesAdmin\VideoAdmin;

use App\Models\video;

class CreateVideo
{
    public function create()
    {
        return view('admin.video.create');
    }

    public function store($request)
    {
        video::create([
            'link_video' => $request->link_video,
            'content' => $request->content,
        ]);

        $video = video::get();

        return view('admin.video.index', compact('video'));
    }
}
