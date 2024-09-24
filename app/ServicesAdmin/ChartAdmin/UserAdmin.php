<?php

namespace App\ServicesAdmin\ChartAdmin;

use App\Models\kinhnguyet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserAdmin
{
    public function index()
    {
        return view('admin.listUser');
    }

    public function listUsers()
    {
        $users = DB::table('nguoidung')
            ->leftJoin('thaiki', 'nguoidung.maNguoiDung', '=', 'thaiki.maNguoiDung')
            ->leftJoin('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->leftJoin('hutsua', 'nguoidung.maNguoiDung', '=', 'hutsua.maNguoiDung')
            ->where('nguoidung.maPhanQuyen', 4)
            ->select(
                'nguoidung.maNguoiDung',
                'nguoidung.tenNguoiDung',
                'nguoidung.email',
                'nguoidung.taiKhoan',
                'nguoidung.namSinh',
                DB::raw('(
                        SELECT CASE 
                            WHEN ketquatest.ketQua BETWEEN 0 AND 25 THEN 0
                            WHEN ketquatest.ketQua BETWEEN 26 AND 65 THEN 1
                            WHEN ketquatest.ketQua BETWEEN 66 AND 100 THEN 2
                            ELSE NULL
                        END 
                        FROM ketquatest 
                        WHERE ketquatest.maQuanLyQueTest = quanlyquetest.maQuanLyQueTest 
                        ORDER BY ketquatest.thoiGian DESC 
                        LIMIT 1
                    ) AS ketQua'),
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(thaiki.ngayDuSinh / 1000), "%d-%m-%Y") AS ngayDuSinh'),
                DB::raw('(
                    SELECT MAX(thoiGian)
                    FROM hutsua
                    WHERE hutsua.maNguoiDung = nguoidung.maNguoiDung
                ) AS timeKich')
            )
            ->limit(100)
            ->get();

        $countUserAge = "";

        $countUserPhase = "";

        $phase = "";

        $thoiGianTu = '';

        $thoiGianDen = '';

        return view('admin.users.listUsers', compact('users', 'countUserAge', 'countUserPhase', 'phase', 'thoiGianTu', 'thoiGianDen'));
    }

    public function detailsUser($id)
    {
        $data = DB::table('quanlyquetest')
            ->join('ketquatest', 'quanlyquetest.maQuanLyQueTest', '=', 'ketquatest.maQuanLyQueTest')
            ->where('quanlyquetest.maNguoiDung', $id)
            ->where('maLoaiQue', 1)
            ->select('quanlyquetest.*', 'ketquatest.*')
            ->orderBy('ketquatest.thoiGian', 'desc')
            ->get();

        $userDetail = kinhnguyet::where('maNguoiDung', $id)
            ->where('trangThai', 1)
            ->get();

        $data->map(function ($item) {
            if ($item->thoiGian) {
                $item->thoiGian = Carbon::createFromTimestamp($item->thoiGian / 1000)->toDateTimeString();
            }
        });

        $userDetail->each(function ($item) {
            foreach (['ngayBatDau', 'ngayKetThuc', 'ngayBatDauKinh', 'ngayKetThucKinh', 'ngayBatDauTrung', 'ngayKetThucTrung'] as $field) {
                if ($item->$field) {
                    $item->$field = Carbon::createFromTimestamp($item->$field / 1000)->format('d-m-Y');
                }
            }
        });

        return view('admin.users.charts', compact('data', 'id', 'userDetail'));
    }

    public function searchUser($request)
    {
        $searchTerm = '%' . $request->input('searchUser') . '%';

        $users = DB::table('nguoidung')
            ->leftJoin('thaiki', 'nguoidung.maNguoiDung', '=', 'thaiki.maNguoiDung')
            ->where('nguoidung.maPhanQuyen', 4)
            ->where(function ($query) use ($searchTerm) {
                $query->where('taiKhoan', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            })
            ->select(
                'nguoidung.maNguoiDung',
                'nguoidung.tenNguoiDung',
                'nguoidung.email',
                'nguoidung.taiKhoan',
                'nguoidung.namSinh',
                DB::raw('DATE_FORMAT(FROM_UNIXTIME(thaiki.ngayDuSinh / 1000), "%d-%m-%Y") AS ngayDuSinh')
            )
            ->get();

        $countUserAge = "";

        $countUserPhase = "";

        $phase = "";

        $thoiGianTu = '';

        $thoiGianDen = '';

        return view('admin.users.listUsers', compact('users', 'countUserAge', 'countUserPhase', 'phase', 'thoiGianTu', 'thoiGianDen'));
    }
}
