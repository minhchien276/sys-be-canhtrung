<?php

namespace App\Services\QrSua;

use App\Models\qrsua;
use Carbon\Carbon;

class updateQrSua
{
    public function hanlde($request, $id)
    {
        $today = Carbon::now();
        $expired = Carbon::now()->addDays(10);

        $qrsua = qrsua::where('maQr', $id)->first();

        if (!$qrsua) {
            return response()->json([
                'message' => 'Mã QR không tồn tại',
                'status' => false
            ], 404);
        }

        if ($qrsua->maNguoiDung) {
            return response()->json([
                'message' => 'Mã QR đã được sử dụng',
                'status' => false
            ], 400);
        }

        $qrsua = qrsua::where('maQr', $id)->update([
            'maNguoiDung' => $request->maNguoiDung,
            'expired' => $expired->toDateTimeString(),
            'updated_at' => $today->toDateTimeString(),
        ]);

        return response()->json([
            'data' => $qrsua,
            'message' => 'Cập nhật mã QR thành công',
            'status' => true
        ], 200);
    }
}
