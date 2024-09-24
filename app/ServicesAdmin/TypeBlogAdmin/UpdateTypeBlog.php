<?php

namespace App\ServicesAdmin\TypeBlogAdmin;

use App\Models\typeblog;
use Exception;

class UpdateTypeBlog
{
    public function update($request, $id)
    {
        try {
            $type_blog = typeblog::find($id);

            if ($type_blog) {
                $newTypeBlog = $request->input('type_blog');
                $newTypeBlogName = $request->input('name');
                $newTypeBlogStatus = $request->input('status');
                $newTypeBlogIsHorizontal = $request->input('isHorizontal');

                $type_blog->type = $newTypeBlog;
                $type_blog->name = $newTypeBlogName;
                $type_blog->status = $newTypeBlogStatus;
                $type_blog->isHorizontal = $newTypeBlogIsHorizontal;

                $type_blog->save();

                return response()->json(['success' => 'Sửa thể loại thành công']);
            } else {
                return response()->json(['error' => 'Không tìm thấy thể loại']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Sửa thể loại thất bại: ' . $e->getMessage()]);
        }
    }
}
