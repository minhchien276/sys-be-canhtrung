<?php
namespace App\Services\ChoAn;

use App\Models\choan;

class updateChoAn
{
    public function handle($request, $id)
    {
        $choan = choan::where('maChoAn', $id)->update([
            "maLoaiChoAn" => $request->maLoaiChoAn,
            "maCon" => $request->maCon,
            "trongLuong" => $request->trongLuong,
            "lanChoAn" => $request->lanChoAn,
            "thoiGian" => $request->thoiGian,
            "loaiThucPham" => $request->loaiThucPham,
            "vuTrai" => $request->vuTrai,
            "vuPhai" => $request->vuPhai,
            "ngayTao" => $request->ngayTao,
        ]);

        return $choan;
    }
}