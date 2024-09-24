<?php
namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class deleteLuongKinh
{
    public function handle($id)
    {
        $luongkinh = luongkinh::where('maLuongKinh', $id)->update([
            'tonTai' => 1
        ]);

        return $luongkinh;
    }
}
