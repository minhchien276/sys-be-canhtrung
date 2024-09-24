<?php

namespace App\ServicesAdmin\VideoAdmin;

use App\Models\video;

class EditVideo
{
    public function edit($id)
    {
        $video = video::where('id', $id)->first();

        return view('admin.video.edit', compact('video'));
    }

    public function update($request, $id)
    {
        Video::where('id', $id)->update([
            'link_video' => $request->link_video,
            'content' => $request->content,
        ]);

        $video = video::get();

        return view('admin.video.index', compact('video'));
    }
}
