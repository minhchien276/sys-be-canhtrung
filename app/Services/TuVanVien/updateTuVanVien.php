<?php
namespace App\Services\TuVanVien;

use App\Models\tuvanvien;

class updateTuVanVien
{
    public function handle($request, $id)
    {
        $soDienThoai = $request->soDienThoai;
        
        if (strpos($soDienThoai, '84') === 0) {
            $soDienThoai = '0' . substr($soDienThoai, 2);
        }
        if (strpos($soDienThoai, '+84') === 0) {
            $soDienThoai = '0' . substr($soDienThoai, 3);
        }
        
        $ttv = tuvanvien::where('maTvv', $id)->update([
            "tenTvv" => $request->tenTvv,
            "linkZalo" => $request->linkZalo,
            "soDienThoai" => $soDienThoai,
            "linkAnh" => $request->linkAnh,
            "kinhnghiem" => $request->kinhnghiem,
            "gioithieu" => $request->gioithieu,
            "rating" => $request->rating,
            "linkFb" => $request->linkFb,
            "status" => $request->status,
            "id_loaitvv" => $request->id_loaitvv,
        ]);

        return $ttv;
    }
}