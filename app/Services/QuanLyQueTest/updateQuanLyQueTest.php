<?php
namespace App\Services\QuanLyQueTest;

use App\Models\hoptest;
use App\Models\quanlyquetest;

class updateQuanLyQueTest
{
    public function handle($id)
    {
        $hoptest = hoptest::where('maNguoiDung', $id)->get();
        $slhoptest = $hoptest->count();

        $slquethai = $slhoptest;
        $slquetrung = $slhoptest * 12;

        $qlqt = quanlyquetest::where('maNguoiDung', $id)->update([
            'soLuongQueThai' => $slquethai,
            'soLuongQueTrung' => $slquetrung,
        ]);

        return $qlqt;
    }
}