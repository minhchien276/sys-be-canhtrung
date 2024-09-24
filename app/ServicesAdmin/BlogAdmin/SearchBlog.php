<?php

namespace App\ServicesAdmin\BlogAdmin;

use App\Models\blog;
use Carbon\Carbon;

class SearchBlog
{
    public function findByType($id)
    {
        $blogs = blog::where('type_blog_id', $id)->get();

        $blogs->map(function ($item) {
            $item->date = Carbon::createFromTimestamp($item->date / 1000)->toDateTimeString();
            return $item;
        });

        return view('admin.blog.blogDetails', compact('blogs', 'id'));
    }
}
