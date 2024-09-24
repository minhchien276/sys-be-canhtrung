<?php

namespace App\ServicesAdmin\TuVanVienAdmin;

use App\Models\tuvanvien;
use App\Models\tvv_nguoidung;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class UserTuVanVien
{
    public function tvv_nguoidung($id)
    {
        $tvv_nguoidung = DB::table('tvv_nguoidung')
            ->join('tuvanvien', 'tvv_nguoidung.maTvv', '=', 'tuvanvien.maTvv')
            ->join('nguoidung', 'nguoidung.maNguoiDung', '=', 'tvv_nguoidung.maNguoiDung')
            ->rightJoin('quanlyquetest', 'quanlyquetest.maNguoiDung', '=', 'tvv_nguoidung.maNguoiDung')
            ->where('tvv_nguoidung.maTvv', '=', $id)
            ->select('tvv_nguoidung.thoiGian', 'tuvanvien.tenTvv', 'nguoidung.tenNguoiDung', 'nguoidung.maNguoiDung', 'nguoidung.taiKhoan', 'quanlyquetest.soLuongQueThai', 'quanlyquetest.soLuongQueTrung')
            ->get();

        return view('admin.tuvanvien.khachhang', compact('tvv_nguoidung'));
    }

    public function findUserByPhoneNumber($request)
    {
        $user = DB::table('nguoidung')
            ->leftJoin('thaiki', 'nguoidung.maNguoiDung', '=', 'thaiki.maNguoiDung')
            ->where('nguoidung.maPhanQuyen', 4)
            ->select('nguoidung.maNguoiDung', 'nguoidung.tenNguoiDung', 'nguoidung.email', 'nguoidung.taiKhoan', 'nguoidung.namSinh', 'nguoidung.chieuCao', 'nguoidung.canNang', 'thaiki.ngayDuSinh')
            ->where('nguoidung.taiKhoan', $request->phone_number)
            ->get();

        $user->map(function ($item) {
            if ($item->ngayDuSinh) {
                $ngayDuSinh = Carbon::createFromTimestamp($item->ngayDuSinh / 1000);
                $item->ngayDuSinh = $ngayDuSinh->format('Y-m-d');
            }

            return $item;
        });

        $tvv = tuvanvien::all();

        $thongbao = '';

        return view('admin.tuvanvien.listTvv', compact('user', 'tvv', 'thongbao'));
    }

    public function AddUser($id)
    {
        $maNguoiDung = $id;
        $maTvv = session()->get('maNguoiDung');

        try {
            tvv_nguoidung::create([
                'maNguoiDung' => $maNguoiDung,
                'maTvv' => $maTvv,
                'thoiGian' => Carbon::now(),
            ]);

            $tvv = tuvanvien::all();

            $user = [];

            $thongbao = 'Bạn đã thêm thành công!';
        } catch (Exception $e) {
            $tvv = tuvanvien::all();

            $user = [];

            $thongbao = 'Bạn đã thêm khách hàng này rồi!';
        }

        return view('admin.tuvanvien.listTvv', compact('tvv', 'thongbao', 'user'));
    }
}
