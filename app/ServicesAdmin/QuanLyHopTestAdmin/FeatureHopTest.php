<?php

namespace App\ServicesAdmin\QuanLyHopTestAdmin;

use Illuminate\Support\Facades\DB;

class FeatureHopTest
{
    public function countHopTest($request)
    {
        $ngayTao = $request->ngayTao;

        $ngayBatDau = strtotime($ngayTao . ' 00:00:00') * 1000;

        $ngayKetThuc = strtotime($ngayTao . ' 23:59:59') * 1000;

        $count_hoptest = DB::table('hoptest')->whereBetween('thoiGian', [$ngayBatDau, $ngayKetThuc])->count();

        $hoptest = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoidung', '=', 'quanlyquetest.maNguoidung')
            ->select('nguoidung.tenNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.soLuongQueThai', 'quanlyquetest.soLuongQueTrung', 'quanlyquetest.ngayTao', 'quanlyquetest.maQuanLyQueTest')
            ->get();

        return view('admin.hoptest.hopTestDaDung', compact('hoptest', 'ngayTao', 'count_hoptest'));
    }

    public function addLuotTest($maQuanLyQueTest)
    {
        $hoptest = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoidung', '=', 'quanlyquetest.maNguoidung')
            ->where('quanlyquetest.maQuanLyQueTest', '=', $maQuanLyQueTest)
            ->select('nguoidung.tenNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.soLuongQueThai', 'quanlyquetest.soLuongQueTrung', 'quanlyquetest.ngayTao', 'quanlyquetest.maQuanLyQueTest')
            ->first();

        return view('admin.hoptest.addLuotTest', compact('hoptest'));
    }

    public function postThemQueTrung($request, $maQuanLyQueTest)
    {
        DB::table('quanlyquetest')->where('maQuanLyQueTest', $maQuanLyQueTest)->update([
            'soLuongQueTrung' => $request->soLuongQueTrung,
        ]);

        $ngayTao = $request->ngayTao;

        $count_hoptest = '';

        $hoptest = DB::table('nguoidung')
            ->join('quanlyquetest', 'nguoidung.maNguoidung', '=', 'quanlyquetest.maNguoidung')
            ->select('nguoidung.tenNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.soLuongQueThai', 'quanlyquetest.soLuongQueTrung', 'quanlyquetest.ngayTao', 'quanlyquetest.maQuanLyQueTest')
            ->get();

        return view('admin.hoptest.hopTestDaDung', compact('hoptest', 'ngayTao', 'count_hoptest'));
    }
}
