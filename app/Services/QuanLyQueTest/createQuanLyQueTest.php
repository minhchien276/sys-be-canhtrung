<?php
namespace App\Services\QuanLyQueTest;

use App\Models\hoptest;
use App\Models\quanlyquetest;

class createQuanLyQueTest
{
    public function handle($request)
    {
        $hoptest = hoptest::where('maNguoiDung', $request->maNguoiDung)->get();
        $slhoptest = $hoptest->count();

        $slquethai = $slhoptest;
        $slquetrung = $slhoptest * 12;

        $qlqt = quanlyquetest::create([
            'maNguoiDung' => $request->maNguoiDung,
            'soLuongQueThai' => $slquethai,
            'soLuongQueTrung' => $slquetrung,
            'ngayTao' => now()->format('Y-m-d'),
        ]);

        return $qlqt;
    }
}