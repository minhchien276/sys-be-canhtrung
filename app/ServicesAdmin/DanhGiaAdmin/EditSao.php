<?php

namespace App\ServicesAdmin\DanhGiaAdmin;

use App\Models\tuvanvien;

class EditSao
{
    public function editSao($id)
    {
        $tvv = tuvanvien::find($id);

        return view('admin.danhgia.editSao', compact('tvv'));
    }

    public function updateSao($request, $id)
    {
        $tvv = tuvanvien::all();

        tuvanvien::where('maTvv', $id)->update([
            'rating' => $request->rating
        ]);

        return view('admin.danhgia.listTvv', compact('tvv'));
    }
}
