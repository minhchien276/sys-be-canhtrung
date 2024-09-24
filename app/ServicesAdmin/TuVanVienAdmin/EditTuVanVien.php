<?php

namespace App\ServicesAdmin\TuVanVienAdmin;

use App\Models\loaitvv;
use App\Models\tuvanvien;
use Illuminate\Support\Facades\DB;

class EditTuVanVien
{
    public function edit($id)
    {
        $tvv = DB::table('tuvanvien')
            ->join('loaitvv', 'tuvanvien.id_loaitvv', '=', 'loaitvv.id')
            ->select('tuvanvien.*', 'loaitvv.type')
            ->where('maTvv', $id)
            ->first();

        $listOfLoaitvv = DB::table('loaitvv')->get();

        return view('admin.tuvanvien.editTvv', compact('tvv', 'listOfLoaitvv'));
    }

    public function update($request, $id)
    {
        tuvanvien::where('maTvv', $id)->update([
            "tenTvv" => $request->tenTvv,
            "linkZalo" => $request->linkZalo,
            "soDienThoai" => $request->soDienThoai,
            "linkAnh" => $request->linkAnh,
            "kinhnghiem" => $request->kinhnghiem,
            "gioithieu" => $request->gioithieu,
            "linkFb" => $request->linkFb,
            "status" => $request->status,
            "id_loaitvv" => $request->id_loaitvv,
        ]);

        $thongbao = '';

        $user = [];

        $tvv = tuvanvien::all();

        $loaitvv = loaitvv::all();

        return view('admin.tuvanvien.listTvv', compact('tvv', 'loaitvv', 'user', 'thongbao'));
    }
}
