<?php

namespace App\Services\LuongKinh;

use App\Models\luongkinh;

class createLuongKinh
{
    public function handle($request)
    {
        $luongkinh = luongkinh::where('maNguoiDung', $request->maNguoiDung)
            ->where('thoiGian', $request->thoiGian)
            ->first();



        if ($luongkinh) {
            if ($luongkinh->tonTai == 1) {
                $res = $luongkinh;
                $luongkinh = luongkinh::where('maLuongKinh', $luongkinh->maLuongKinh)->update([
                    'luongKinh' => $request->luongKinh,
                    'tonTai' => 0
                ]);

                return $res;
            } else {
                $luongkinh = luongkinh::where('maLuongKinh', $luongkinh->maLuongKinh)->update([
                    'luongKinh' => $request->luongKinh
                ]);
            }

            return response()->json([
                'message' => 'Luongkinh đã được tạo',
                'status' => false
            ], 400);
        }

        $luongkinh = luongkinh::create([
            'maNguoiDung' => $request->maNguoiDung,
            'luongKinh' => $request->luongKinh,
            'thoiGian' => $request->thoiGian,
        ]);

        return $luongkinh;
    }
}
