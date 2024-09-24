<?php

namespace App\Services\TypeBlog;

use App\Models\typeblog;

class deleteTypeBlog
{
    public function handle($id)
    {
        $typeblog = typeblog::where('id', $id)->delete();

        return $typeblog;
    }
}
