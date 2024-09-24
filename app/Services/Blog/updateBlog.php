<?php
namespace App\Services\Blog;

use App\Models\blog;

class updateBlog
{
    public function handle($request, $id)
    {
        $blog = blog::where('id', $id)->update([
            'image' => $request->image,
            'title' => $request->title,
            'content' => $request->content,
            'link' => $request->link,
            'date' => $request->date,
        ]);

        return $blog;
    }
}