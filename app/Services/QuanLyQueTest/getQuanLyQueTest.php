<?php

namespace App\Services\QuanLyQueTest;

use App\Models\hoptest;
use App\Models\quanlyquetest;
use App\Supports\Responder;

class getQuanLyQueTest
{
    public function handle($id)
    {
        $hoptest = hoptest::where('maNguoiDung', $id)->get();
        $slhoptest = $hoptest->count();

        if ($slhoptest == 0) {
            return Responder::success(null, 'Lấy quản lý que test thành công');
        }

        $slquethai = $slhoptest;
        $slquetrung = $slhoptest * 12;

        $qlqt = quanlyquetest::where('maNguoiDung', $id)->first();
        $qlqt->tongQueThai = $slquethai;
        $qlqt->tongQueTrung = $slquetrung;

        if ($qlqt) {
            return Responder::success($qlqt, 'Lấy quản lý que test thành công');
        }
    }
}
