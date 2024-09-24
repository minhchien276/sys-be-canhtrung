<?php
namespace App\Services\TypeBlog;

use App\Models\typeblog;

class getTypeBlog
{
    public function handle($phase)
    {
        $typeBlog = typeblog::where('phase', $phase)->where('status', 1)->get();

        return $typeBlog;
    }
}