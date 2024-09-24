<?php

namespace App\ServicesAdmin\TaiLieuKichSuaAdmin;

use App\Models\tailieukichsua;
use Carbon\Carbon;

class CreateTaiLieuKichSua
{
    public function create()
    {
        return view('admin.tailieukichsua.create');
    }

    public function store($request)
    {
        try {
            $now = Carbon::now();

            $tailieu = tailieukichsua::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'link' => $request->link,
                'type' => $request->type,
                'created_at' => $now,
            ]);

            if (!$tailieu) {
                return redirect()->back()->with('error', 'Tạo mới tài liệu không thành công!');
            }

            return redirect()->back()->with('success', 'Tạo mới tài liệu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tạo mới tài liệu không thành công');
        }
    }
}
