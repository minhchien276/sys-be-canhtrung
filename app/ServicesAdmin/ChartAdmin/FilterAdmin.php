<?php

namespace App\ServicesAdmin\ChartAdmin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FilterAdmin
{
    public function filterAge($request)
    {
        $tuoi = $request->age;

        $namhientai = Carbon::now()->year;

        $namsinh = $namhientai - $tuoi;

        $users = DB::table('nguoidung')
            ->leftJoin('thaiki', 'nguoidung.maNguoiDung', '=', 'thaiki.maNguoiDung')
            ->leftJoin('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->leftJoin('hutsua', 'nguoidung.maNguoiDung', '=', 'hutsua.maNguoiDung')
            ->where('nguoidung.maPhanQuyen', 4)
            ->where('nguoidung.namSinh', $namsinh)
            ->select(
                'nguoidung.maNguoiDung',
                'nguoidung.tenNguoiDung',
                'nguoidung.email',
                'nguoidung.taiKhoan',
                'nguoidung.namSinh',
                'thaiki.ngayDuSinh',
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
                DB::raw('(
                    SELECT MAX(thoiGian)
                    FROM hutsua
                    WHERE hutsua.maNguoiDung = nguoidung.maNguoiDung
                ) AS timeKich')
                )
            ->get();

        $users->map(function ($item) {
            if ($item->ngayDuSinh) {
                $ngayDuSinh = Carbon::createFromTimestamp($item->ngayDuSinh / 1000);
                $item->ngayDuSinh = $ngayDuSinh->format('d-m-Y');
            }

            return $item;
        });

        $countUserAge = $users->count();

        $countUserPhase = "";

        $phase = "";

        $thoiGianTu = '';

        $thoiGianDen = '';

        return view('admin.users.listUsers', compact('users', 'countUserAge', 'countUserPhase', 'phase', 'thoiGianTu', 'thoiGianDen'));
    }

    public function filterPhase($request)
    {
        $phase = $request->phase;
        $users = [];

        $thoiGianTu = $request->thoiGianTu;
        $thoiGianDen = $request->thoiGianDen;

        $millisecondsTu = strtotime(date('Y-m-d 00:00:01', strtotime($request->thoiGianTu))) * 1000;
        $millisecondsDen = strtotime(date('Y-m-d 23:59:59', strtotime($request->thoiGianDen))) * 1000;

        $subQuery = DB::table('thaiki')
            ->select('maNguoiDung', DB::raw('MAX(ngayDuSinh) as ngayDuSinh'))
            ->groupBy('maNguoiDung');
    
        $subQuery2 = DB::table('hutsua')
            ->select('maNguoiDung', DB::raw('MAX(thoiGian) as timeKich'))
            ->groupBy('maNguoiDung');
        
        $query = DB::table('nguoidung')
            ->leftJoinSub($subQuery, 'thaiki', function ($join) {
                $join->on('nguoidung.maNguoiDung', '=', 'thaiki.maNguoiDung');
            })
            ->leftJoinSub($subQuery2, 'hutsua', function ($join) {
                $join->on('nguoidung.maNguoiDung', '=', 'hutsua.maNguoiDung');
            })
            ->leftJoin('quanlyquetest', 'nguoidung.maNguoiDung', '=', 'quanlyquetest.maNguoiDung')
            ->select(
                'nguoidung.maNguoiDung',
                'nguoidung.tenNguoiDung',
                'nguoidung.email',
                'nguoidung.taiKhoan',
                'nguoidung.namSinh',
                'thaiki.ngayDuSinh',
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
                'hutsua.timeKich'
            );

        if ($phase != 0) {
            $query->where('nguoidung.phase', $phase);
        }

        if ($millisecondsDen != 57599000) {
            $query->whereBetween('nguoidung.ngayTao', [$millisecondsTu, $millisecondsDen]);
        }

        $users = $query->orderBy('nguoidung.ngayTao', 'desc')
            ->limit(1000) 
            ->get();

        $users->map(function ($item) {
            if ($item->ngayDuSinh) {
                $ngayDuSinh = Carbon::createFromTimestamp($item->ngayDuSinh / 1000);
                $item->ngayDuSinh = $ngayDuSinh->format('d-m-Y');
            }
            return $item;
        });

        $countUserPhase = count($users);

        $countUserAge = "";


        return view('admin.users.listUsers', compact('users', 'countUserPhase', 'countUserAge', 'phase', 'thoiGianTu', 'thoiGianDen'));
    }
}
