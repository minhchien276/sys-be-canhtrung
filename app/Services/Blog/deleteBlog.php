<?php

namespace App\Services\Blog;

use App\Models\blog;

class deleteBlog
{
    public function handle($id)
    {
        $blog = blog::where('id', $id)->delete();

        return $blog;
    }
}
