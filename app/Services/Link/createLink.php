<?php
namespace App\Services\Link;

use App\Models\link;

class createLink 
{
    public function handle($request)
    {
        $link = link::create([
            "tenLink" => $request->tenLink,
            "title" => $request->title,
            "member" => $request->member,
            "image" => $request->image,
            "description" => $request->description,
        ]);

        return $link;
    }
}