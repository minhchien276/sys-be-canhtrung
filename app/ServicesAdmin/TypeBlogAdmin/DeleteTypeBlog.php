<?php

namespace App\ServicesAdmin\TypeBlogAdmin;

use App\Models\typeblog;
use Exception;

class DeleteTypeBlog
{
    public function delete($id)
    {
        try {
            $type_blog = typeblog::find($id);

            if ($type_blog) {
                $type_blog->delete();
                return response()->json(['success' => 'Xóa thể loại thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy thể loại']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Xóa thể loại thất bại: ' . $e->getMessage()]);
        }
    }
}
