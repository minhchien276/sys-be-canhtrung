<?php

namespace App\ServicesAdmin\BlogAdmin;

use App\Models\blog;
use Exception;

class DeleteBlog
{
    public function delete($id)
    {
        try {
            $blog = blog::find($id);

            if ($blog) {
                $blog->delete();
                return response()->json(['success' => 'Xóa bài viết thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy bài viết']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa bài viết thất bại: ' . $e->getMessage()]);
        }
    }
}
