<?php

namespace App\ServicesAdmin\BlogAdmin;

use App\Models\blog;
use Carbon\Carbon;
use Exception;

class CreateBlog
{
    public function loadListBlog()
    {
        $type_blog_id = request('type_blog_id');

        $blogs = blog::where('type_blog_id', $type_blog_id)->get();

        $blogs->map(function ($item) {
            $item->date = Carbon::createFromTimestamp($item->date / 1000)->toDateTimeString();
            return $item;
        });

        return view('admin.blog.listBlog', compact('blogs', 'type_blog_id'));
    }

    public function create($request)
    {
        $date = Carbon::now();
        $milliseconds = $date->timestamp * 1000;

        try {
            $blog = blog::create([
                'image' => $request->image,
                'title' => $request->title,
                'content' => $request->content,
                'link' => $request->link,
                'date' => $milliseconds,
                'type_blog_id' => $request->type_blog_id,
            ]);

            // Tạo lại danh sách bài viết mới sau khi thêm thành công
            $blogs = blog::where('type_blog_id', $request->type_blog_id)->get();
            $blogs->map(function ($item) {
                $item->date = Carbon::createFromTimestamp($item->date / 1000)->toDateTimeString();
                return $item;
            });

            // Trả về HTML mới cho danh sách bài viết
            $view = view('admin.blog.listBlog', compact('blogs'))->render();
            return response()->json(['success' => 'Thêm mới thành công!', 'html' => $view]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }
}
