<?php

namespace App\Services\QrSua;

use App\Models\qrsua;
use Carbon\Carbon;

class getQrSua
{
    public function hanlde($request)
    {
        $check = qrsua::where('maNguoiDung', $request->maNguoiDung)->orderBy('created_at', 'desc')->first();
        $today = Carbon::today()->format('Y-m-d');
        
        if (!$check) {
            return response()->json([
                'message' => 'Bạn chưa quét mã QR',
                'status' => false
            ], 400);
        }

        if ($check->expired < $today) {
            return response()->json([
                'message' => 'Mã QR đã hết hạn',
                'status' => false
            ], 400);
        }

        return response()->json([
            'message' => 'Mã QR còn dùng',
            'status' => true
        ], 200);
    }
}
