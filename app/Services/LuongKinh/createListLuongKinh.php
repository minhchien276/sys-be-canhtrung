<?php

namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class createListLuongKinh
{
    public function handle($request)
    {
        $listLuongKinh = $request->listLuongKinh;

        foreach ($listLuongKinh as $item) {
            $luongkinh = luongkinh::where('maNguoiDung', $item->maNguoiDung)
                ->where('thoiGian', $item->thoiGian)
                ->first();

            if ($luongkinh) {
                if ($luongkinh->tonTai == 1) {
                    $res = $luongkinh;
                    $luongkinh = luongkinh::where('maLuongKinh', $luongkinh->maLuongKinh)->update([
                        'luongKinh' => $item->luongKinh,
                        'tonTai' => 0
                    ]);

                    return $res;
                } else {
                    $luongkinh = luongkinh::where('maLuongKinh', $luongkinh->maLuongKinh)->update([
                        'luongKinh' => $item->luongKinh
                    ]);
                }

                return response()->json([
                    'message' => 'Luongkinh đã được tạo',
                    'status' => false
                ], 400);
            }

            $luongkinh = luongkinh::create([
                'maNguoiDung' => $item->maNguoiDung,
                'luongKinh' => $item->luongKinh,
                'thoiGian' => $item->thoiGian,
            ]);

            return $luongkinh;
        }
    }
}
