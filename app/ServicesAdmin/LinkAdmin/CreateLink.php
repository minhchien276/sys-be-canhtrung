<?php

namespace App\ServicesAdmin\LinkAdmin;

use App\Models\link;
use Exception;

class CreateLink
{
    public function create($request)
    {
        $link = $request->input('link');
        $title = $request->input('title');
        $description = $request->input('description');
        $member = $request->input('member');
        $image = $request->input('image');

        try {
            link::create([
                'tenLink' => $link,
                'title' => $title,
                'description' => $description,
                'member' => $member,
                'image' => $image,
            ]);

            return redirect()->back()->with('success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Thêm mới thất bại: ' . $e->getMessage());
        }
    }
}
