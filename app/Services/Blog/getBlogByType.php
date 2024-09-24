<?php
namespace App\Services\Blog;

use App\Models\blog;

class getBlogByType
{
    public function handle($type_blog_id)
    {
        $blogs = blog::where('type_blog_id', $type_blog_id)->get();

        return $blogs;
    }
}