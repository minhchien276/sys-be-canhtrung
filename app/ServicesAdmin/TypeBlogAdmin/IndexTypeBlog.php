<?php

namespace App\ServicesAdmin\TypeBlogAdmin;

use Illuminate\Support\Facades\DB;

class IndexTypeBlog
{
    public function index()
    {
        $blogs = DB::table('blog')
            ->rightJoin('type_blog', 'blog.type_blog_id', '=', 'type_blog.id')
            ->select('blog.type_blog_id', 'type_blog.*')
            ->distinct()
            ->get();

        return view('admin.blog.blogs', compact('blogs'));
    }
}
