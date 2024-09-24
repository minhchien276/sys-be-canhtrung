<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class updateKinhNguyet
{
    public function handle($request, $id)
    {
        if ($id) {
            $kinhNguyet = kinhnguyet::where('maNguoiDung', $id)
                ->where('ngayBatDau', $request->ngayBatDau)
                ->first();

            if ($kinhNguyet) {
                $kinhNguyet->trangThai = $request->trangThai;
                $kinhNguyet->save();

                return $kinhNguyet;
            }

            return response()->json([
                'message' => 'Không tìm thấy kinh nguyệt',
                'status' => false
            ], 404);
        }

        return response()->json([
            'message' => 'Vui lòng nhập ID',
            'status' => false
        ], 400);
    }
}
