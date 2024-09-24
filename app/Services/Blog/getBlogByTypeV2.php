<?php

namespace App\Services\Blog;

use App\Models\blog;
use App\Models\typeblog;

class getBlogByTypeV2
{
    public function handle($name)
    {
        $typeblogs = typeblog::where('name', $name)->get();

        $data = [];
        foreach ($typeblogs as $item) {
            $blogs = blog::where('type_blog_id', $item->id)->get();

            if ($blogs) {
                $data[] = [
                    "name" => $item->type,
                    "isHorizontal" => $item->isHorizontal,
                    "blogs" => $blogs
                ];
            }
        }

        return $data;
    }
}
