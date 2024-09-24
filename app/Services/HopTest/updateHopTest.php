<?php

namespace App\Services\HopTest;

use App\Models\hoptest;
use App\Models\quanlyquetest;
use App\Services\QuanLyQueTest\getQuanLyQueTest;

class updateHopTest
{
    private $getQuanLyQueTest;

    public function __construct(
        getQuanLyQueTest $getQuanLyQueTest
    ) {
        $this->getQuanLyQueTest = $getQuanLyQueTest;
    }

    public function handle($request, $id)
    {
        $qlqt = quanlyquetest::where('maNguoiDung', $request->maNguoiDung)->first();

        $check = hoptest::where('maHopTest', $id)->first();
        if ($check->maNguoiDung) {
            return response()->json([
                'message' => 'Hộp test đã được sử dụng',
                'status' => false
            ], 200);
        }

        if (hoptest::where('maHopTest', $id)->first()) {
            $hoptest = hoptest::where('maHopTest', $id)->update([
                "maNguoiDung" => $request->maNguoiDung,
                "thoiGian" => $request->thoiGian,
            ]);

            if ($qlqt) {
                quanlyquetest::where('maNguoiDung', $request->maNguoiDung)->update([
                    'soLuongQueThai' => $qlqt->soLuongQueThai + 1,
                    'soLuongQueTrung' => $qlqt->soLuongQueTrung + 12,
                ]);

                $quanlyquetest = $this->getQuanLyQueTest->handle($request->maNguoiDung);
            } else {
                quanlyquetest::create([
                    'maNguoiDung' => $request->maNguoiDung,
                    'soLuongQueThai' => 1,
                    'soLuongQueTrung' => 12,
                ]);

                $quanlyquetest = $this->getQuanLyQueTest->handle($request->maNguoiDung);
            }
        }

        return $quanlyquetest;
    }
}
