<?php

namespace App\ServicesAdmin\QuanLyHopTestAdmin;

use Illuminate\Support\Facades\DB;

class ShowHopTest
{
    public function showHopTestDaDung()
    {
        $ngayTao = '';

        $count_hoptest = '';

        $hoptest = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoidung', '=', 'quanlyquetest.maNguoidung')
            ->select('nguoidung.tenNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.soLuongQueThai', 'quanlyquetest.soLuongQueTrung', 'quanlyquetest.ngayTao', 'quanlyquetest.maQuanLyQueTest')
            ->get();

        return view('admin.hoptest.hopTestDaDung', compact('hoptest', 'ngayTao', 'count_hoptest'));
    }

    public function showHopTestMoi()
    {
        $hoptest = DB::table('hoptest')->where('maNguoiDung', null)->where('thoiGian', null)->select('maHopTest')->get();

        return view('admin.hoptest.hopTestMoi', compact('hoptest'));
    }
}
