<?php

namespace App\ServicesAdmin\QuangCaoAdmin;

use App\Models\quangcao;

class EditQuangCao
{
    public function edit($id)
    {
        $quangcao = quangcao::where('id', $id)->first();

        return view('admin.quangcao.editQuangCao', compact('quangcao'));
    }

    public function update($request, $id)
    {
        quangcao::where('id', $id)->update([
            'image' => $request->image,
            'status' => $request->status,
            'link' => $request->link,
        ]);

        $quangcao = quangcao::all();

        return view('admin.quangcao.quangCao', compact('quangcao'));
    }
}
