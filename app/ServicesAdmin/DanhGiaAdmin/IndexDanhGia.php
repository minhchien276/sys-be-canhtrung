<?php

namespace App\ServicesAdmin\DanhGiaAdmin;

use App\Models\tuvanvien;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexDanhGia
{
    public function index()
    {
        $tvv = tuvanvien::all();

        return view('admin.danhgia.listTvv', compact('tvv'));
    }

    public function showDanhGia($id)
    {
        $danhgia = DB::table('danhgia')
            ->join('tuvanvien', 'tuvanvien.maTvv', '=', 'danhgia.id_tvv')
            ->join('nguoidung', 'nguoidung.maNguoiDung', '=', 'danhgia.id_nguoidung')
            ->select('tuvanvien.tenTvv', 'nguoidung.tenNguoiDung', 'nguoidung.taiKhoan', 'danhgia.danhgia', 'danhgia.sao', 'danhgia.thoiGian')
            ->where('danhgia.id_tvv', '=', $id)
            ->get();

        $danhgia->map(function ($item) {
            $item->thoiGian = Carbon::createFromTimestamp($item->thoiGian / 1000)->toDateTimeString();
            return $item;
        });

        return view('admin.danhgia.danhgia', compact('danhgia'));
    }
}
