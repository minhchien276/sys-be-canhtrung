<?php

namespace App\ServicesAdmin\TaiLieuKichSuaAdmin;

use App\Models\tailieukichsua;
use Carbon\Carbon;

class EditTaiLieuKichSua
{
    public function edit($id)
    {
        $tailieukichsua = tailieukichsua::find($id);

        return view('admin.tailieukichsua.edit', compact('tailieukichsua'));
    }

    public function update($request, $id)
    {
        try {
            $now = Carbon::now();

            $tailieu = tailieukichsua::where('id', $id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'link' => $request->link,
                'type' => $request->type,
                'updated_at' => $now,
            ]);

            if (!$tailieu) {
                return redirect()->back()->with('error', 'Cập nhật tài liệu không thành công!');
            }

            return redirect()->back()->with('success', 'Cập nhật tài liệu thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật tài liệu không thành công');
        }
    }
}
