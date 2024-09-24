<?php
namespace App\Services\TypeBlog;

use App\Models\typeblog;

class updateTypeBlog
{
    public function handle($request, $id)
    {
        $typeBlog = typeblog::where('id', $id)->update([
            'type' => $request->type,
        ]);

        return $typeBlog;
    }
}