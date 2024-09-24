<?php

namespace App\ServicesAdmin\TypeBlogAdmin;

use App\Models\blog;
use App\Models\typeblog;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateTypeBlog
{
    public function create($request)
    {
        try {
            $type_blog = typeblog::create([
                'type' => $request->type_blog,
            ]);

            blog::create([
                'image' => '',
                'title' => '',
                'content' => '',
                'link' => '',
                'date' => '',
                'type_blog_id' => $type_blog->id,
            ]);

            // Cập nhật lại danh sách loại thể loại
            $blogs = $this->loadListTypeBlog();
            return view('admin.blog.blogs', compact('blogs'))->with('success', 'Thêm mới thành công!');
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }

    public function loadListTypeBlog()
    {
        $blogs = DB::table('blog')
            ->rightJoin('type_blog', 'blog.type_blog_id', '=', 'type_blog.id')
            ->select('blog.type_blog_id', 'type_blog.type', 'type_blog.name')
            ->distinct()
            ->get();

        return response()->json(['blogs' => $blogs]);
    }
}
