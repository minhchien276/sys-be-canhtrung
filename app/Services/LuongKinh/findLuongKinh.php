<?php

namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class findLuongKinh
{
    public function handle($id)
    {
        $luowngkinh = luongkinh::where('maNguoiDung', $id)
            ->where('tonTai', 0)
            ->get();

        return $luowngkinh;
    }
}
