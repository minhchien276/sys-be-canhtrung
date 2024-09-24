<?php

namespace App\Services\HutSua;

use App\Models\hutsua;

class createHutSua
{
    public function handle($request)
    {
        $check  = hutsua::where('maNguoiDung', $request->maNguoiDung)->where('ngayTao', $request->ngayTao)->count();

        if ($check < 12) {
            hutsua::create([
                "maNguoiDung" => $request->maNguoiDung,
                "vuTrai" => $request->vuTrai,
                "vuPhai" => $request->vuPhai,
                "lanChoAn" => $request->lanChoAn,
                "thoiGian" => $request->thoiGian,
                "ngayTao" => $request->ngayTao,
            ]);

            $hutsua = hutsua::where('maNguoiDung', $request->maNguoiDung)
                ->where('ngayTao', $request->ngayTao)
                ->orderBy('thoiGian', 'desc')
                ->get();

            return $hutsua;
        }

        return null;
    }
}
