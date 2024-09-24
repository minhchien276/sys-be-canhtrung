<?php

namespace App\Services\HutSua;

use App\Models\hutsua;

class getHutSuaByNgayTao
{
    public function handle($maNguoiDung, $ngayTao)
    {
        $hutsua = hutsua::where('maNguoiDung', $maNguoiDung)
            ->where('ngayTao', $ngayTao)
            ->orderBy('thoiGian', 'desc')
            ->get();

        return $hutsua;
    }
}
