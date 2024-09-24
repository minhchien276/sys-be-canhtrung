<?php

namespace App\ServicesAdmin\QuanLyHopTestAdmin;

use App\Models\hoptest;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateHopTest
{
    public function create($request)
    {
        $data = $request->input('qrCode');
        $qrCodes = preg_split('/\s+/', $data);

        try {
            foreach ($qrCodes as $qrCode) {
                $hoptest = hoptest::where('maHopTest', $qrCode)->first();

                if ($hoptest) {
                    return response()->json(['error' => 'Mã QR đã tồn tại: ' . $qrCode]);
                }

                $newHopTest = hoptest::create([
                    'maHopTest' => $qrCode,
                ]);
            }

            return response()->json(['success' => 'Thêm mới thành công!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Thêm mới thất bại: ' . $e->getMessage()]);
        }
    }

    public function loadHopTestList()
    {
        $hoptest = DB::table('hoptest')->where('maNguoiDung', null)->where('thoiGian', null)->get();

        return view('admin.hoptest.hopTestList', compact('hoptest'));
    }
}
