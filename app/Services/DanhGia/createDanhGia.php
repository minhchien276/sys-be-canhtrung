<?php

namespace App\Services\DanhGia;

use App\Models\danhgia;
use App\Models\hoptest;

class createDanhGia
{
    public function handle($request)
    {
        $exists = hoptest::where('maNguoiDung', $request->id_nguoidung)->exists();

        if ($exists) {
            $danhgia = danhgia::create([
                "id_nguoidung" => $request->id_nguoidung,
                "id_tvv" => $request->id_tvv,
                "danhgia" => $request->danhgia,
                "sao" => $request->sao,
                "thoiGian" => $request->thoiGian,
            ]);

            return $danhgia;
        }

        return false;
    }
}
