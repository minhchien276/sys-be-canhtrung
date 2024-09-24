<?php

namespace App\Services\Link;

use App\Models\link;

class updateLink
{
    public function handle($request, $id)
    {
        $link = link::where('maLink', $id)->update([
            "tenLink" => $request->tenLink,
            "title" => $request->title,
            "member" => $request->member,
            "image" => $request->image,
            "description" => $request->description,
        ]);

        return $link;
    }
}
