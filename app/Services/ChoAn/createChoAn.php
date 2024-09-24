<?php

namespace App\Services\ChoAn;

use App\Models\choan;
use Carbon\Carbon;

class createChoAn
{
    public function handle($request)
    {
        $check  = choan::where('maCon', $request->maCon)->where('ngayTao', $request->ngayTao)->count();
        $today = Carbon::now()->startOfDay()->timestamp * 1000;

        if ($check < 10) {
            choan::create([
                "maLoaiChoAn" => $request->maLoaiChoAn,
                "maCon" => $request->maCon,
                "trongLuong" => $request->trongLuong,
                "lanChoAn" => $request->lanChoAn,
                "thoiGian" => $request->thoiGian,
                "loaiThucPham" => $request->loaiThucPham,
                "vuTrai" => $request->vuTrai,
                "vuPhai" => $request->vuPhai,
                "ngayTao" => $request->ngayTao,
            ]);

            $choan = choan::join('loaichoan', 'choan.maLoaiChoAn', 'loaichoan.maLoaiChoAn')
                ->select('choan.*', 'loaichoan.tenLoaiChoAn', 'loaichoan.donVi')
                ->where('maCon', $request->maCon)
                ->where('ngayTao', $today)
                ->orderBy('thoiGian', 'asc')
                ->get();

            return $choan;
        }

        return null;
    }
}
