<?php
namespace App\Services\QuanLyQueTest;

use App\Models\hoptest;
use App\Models\quanlyquetest;

class findQuanLyQueTest
{
    public function handle($id)
    {
        $hoptest = hoptest::where('maNguoiDung', $id)->get();
        $slhoptest = $hoptest->count();

        if($slhoptest ==0)
        {
            return response()->json([
                'message' => 'fail',
                'data' => []
            ], 200);
        }

        $slquethai = $slhoptest;
        $slquetrung = $slhoptest * 12;

        $qlqt = quanlyquetest::where('maNguoiDung', $id)->first();
        $qlqt->tongQueThai = $slquethai;
        $qlqt->tongQueTrung = $slquetrung;

        if($qlqt)
        {
            return response()->json([
                'message' => 'success',
                'data' => $qlqt,
            ], 200);
        }
    }
}
