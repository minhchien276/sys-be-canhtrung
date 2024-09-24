<?php

namespace App\ServicesAdmin\BlogAdmin;

use App\Models\blog;
use Carbon\Carbon;
use Exception;

class UpdateBlog
{
    public function update($request, $id)
    {
        $date = Carbon::now();
        $milliseconds = $date->timestamp * 1000;

        try {
            $blog = blog::find($id);

            if ($blog) {
                $blog->image = $request->input('image');
                $blog->title = $request->input('title');
                $blog->content = $request->input('content');
                $blog->link = $request->input('link');
                $blog->date = $milliseconds;

                $blog->save();

                return response()->json(['success' => 'Sửa bài viết thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy bài viết']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Sửa bài viết thất bại: ' . $e->getMessage()]);
        }
    }
}
