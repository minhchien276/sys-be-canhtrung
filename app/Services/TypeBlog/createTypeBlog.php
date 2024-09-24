<?php
namespace App\Services\TypeBlog;

use App\Models\typeblog;

class createTypeBlog
{
    public function handle($request)
    {
        $typeBlog = typeblog::create([
            'type' => $request->type,
        ]);

        return $typeBlog;
    }
}