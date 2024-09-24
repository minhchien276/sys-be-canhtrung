<?php
namespace App\Services\Blog;

use App\Models\blog;

class createBlog
{
    public function handle($request)
    {
        $blog = blog::create([
            'image' => $request->image,
            'title' => $request->title,
            'content' => $request->content,
            'link' => $request->link,
            'date' => $request->date,
            'type_blog_id' => $request->type_blog_id,
        ]);

        return $blog;
    }
}