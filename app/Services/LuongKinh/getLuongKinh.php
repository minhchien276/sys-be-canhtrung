<?php

namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class getLuongKinh
{
    public function handle($maNguoiDung, $thoiGian)
    {
        $luongkinh = luongkinh::where('maNguoiDung', $maNguoiDung)
                        ->where('tonTai', 0)
                        ->where('thoiGian', $thoiGian)
                        ->first();

        return $luongkinh;
    }
}
