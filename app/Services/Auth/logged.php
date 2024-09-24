<?php

namespace App\Services\Auth;

use App\Models\ketquatest;
use App\Models\kinhnguyet;
use App\Models\luongkinh;
use App\Models\nhatky;
use App\Models\quanlyquetest;
use App\Models\thaiki;
use Illuminate\Support\Facades\DB;

class logged
{
    public function handle($maNguoiDung)
    {
        $kinhnguyet = kinhnguyet::where('maNguoiDung', $maNguoiDung)->get();

        $luongkinh = luongkinh::where('maNguoiDung', $maNguoiDung)->where('tonTai', 0)->get();

        $nhatky = DB::table('nhatky')
            ->select('nhatky.maNhatKy', 'nhatky.thoiGian', 'nhatky.tonTai', 'cautraloi.maCauHoi', 'cautraloi.cauTraLoi')
            ->leftJoin('cautraloi', 'nhatky.maNhatKy', '=', 'cautraloi.maNhatKy')
            ->where('nhatky.tonTai', 0)
            ->where('nhatky.maNguoiDung', $maNguoiDung)
            ->get();

        $nhatkyFormatted = $nhatky->groupBy('maNhatKy')->map(function ($item) {
            $cauTraLoiFormatted = $item->map(function ($subItem) {
                return [
                    'maCauHoi' => $subItem->maCauHoi,
                    'cauTraLoi' => $subItem->cauTraLoi
                ];
            });
            return [
                'maNhatKy' => $item->first()->maNhatKy,
                'thoiGian' => $item->first()->thoiGian,
                'tonTai' => $item->first()->tonTai,
                'cauTraLoi' => $cauTraLoiFormatted->toArray()
            ];
        })->values();


        $thaiki = thaiki::where('maNguoiDung', $maNguoiDung)->get();

        $ketquatest = quanlyquetest::join('ketquatest', 'ketquatest.maQuanLyQueTest', 'quanlyquetest.maQuanLyQueTest')
            ->join('hoptest', 'quanlyquetest.maNguoiDung', 'hoptest.maNguoiDung')
            ->select('ketquatest.maKetQuaTest', 'ketquatest.maLoaiQue', 'ketquatest.thoiGian', 'ketquatest.lanTest', 'ketquatest.ketQua')
            ->where('hoptest.maNguoiDung', $maNguoiDung)
            ->get();

        $data =  [
            'kinhnguyet' => $kinhnguyet ? $kinhnguyet : [],
            'luongkinh' => $luongkinh ? $luongkinh : [],
            'nhatky' => $nhatkyFormatted ? $nhatkyFormatted : [],
            'thaiki' => $thaiki ? $thaiki : [],
            'ketquatest' => $ketquatest ? $ketquatest : [],
        ];

        return $data;
    }
}
