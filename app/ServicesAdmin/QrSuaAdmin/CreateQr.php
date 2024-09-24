<?php

namespace App\ServicesAdmin\QrSuaAdmin;

use App\Models\qrsua;
use Carbon\Carbon;
use Exception;

class CreateQr
{
    public function create($request)
    {
        $data = $request->input('qrCode');
        $qrCodes = preg_split('/\s+/', $data);

        try {
            foreach ($qrCodes as $qrCode) {
                $qrsua = qrsua::where('maQr', $qrCode)->first();

                if ($qrsua) {
                    return response()->json(['error' => 'Mã QR đã tồn tại: ' . $qrCode]);
                }

                qrsua::create([
                    'maQr' => $qrCode,
                    'created_at' => Carbon::now()->format('Y-m-d'),
                ]);
            }

            return response()->json(['success' => 'Thêm mới thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }
}
