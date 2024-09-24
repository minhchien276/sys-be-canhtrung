<?php

namespace App\Services\NhatKy;

use App\Models\cautraloi;
use App\Models\nhatky;

class createNhatKy
{
    public function handle($request)
    {
        $nhatky = Nhatky::where('maNguoiDung', $request->maNguoiDung)
            ->where('thoiGian', $request->thoiGian)
            ->first();



        if ($nhatky) {
            if ($nhatky->tonTai == 1) {
                $res = $nhatky;
                $nhatky = nhatky::where('maNhatKy', $nhatky->maNhatKy)->update([
                    'tonTai' => 0
                ]);

                return $res;
            }

            return response()->json([
                'message' => 'Nhật ký đã được tạo',
                'status' => false
            ], 400);
        }

        $nhatky = nhatky::create([
            'maNguoiDung' => $request->maNguoiDung,
            'thoiGian' => $request->thoiGian,
        ]);

        return $nhatky;
    }
}
