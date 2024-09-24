<?php

namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class dongBoLuongKinh
{
    public function handle($request, $maNguoiDung)
    {
        $allData = $request->json()->all();

        $luongkinhArray = $allData['luongkinh'];

        foreach ($luongkinhArray as $luongkinh) {
            $thoiGian = $luongkinh['thoiGian'];
            $luongKinh = $luongkinh['luongKinh'];
            $tonTai = $luongkinh['tonTai'];

            $luongKinh = luongkinh::updateOrInsert(
                ['maNguoiDung' => $maNguoiDung, 'thoiGian' => $thoiGian],
                ['luongKinh' => $luongKinh, 'tonTai' => $tonTai]
            );
        }

        $status = $luongKinh ? true : false;

        return response()->json(['status' => $status], $status ? 200 : 400);
    }
}
