<?php

namespace App\Services\ChoAn;

use App\Models\choan;
use Illuminate\Support\Facades\DB;

class getNgayTao
{
    public function handle($maCon, $request)
    {
        $data = $request;

        $ngayTaoRecords = DB::table('choan')
            ->select('ngayTao')
            ->whereIn('maLoaiChoAn', $data->maLoaiChoAn)
            ->where('maCon', $maCon)
            ->distinct()
            ->orderBy('ngayTao', 'desc')
            ->take(7)
            ->get();

        $ngayTaoValues = $ngayTaoRecords->pluck('ngayTao')->toArray();

        $choan = choan::join('loaichoan', 'choan.maLoaiChoAn', 'loaichoan.maLoaiChoAn')
            ->select('choan.*', 'loaichoan.tenLoaiChoAn', 'loaichoan.donVi')
            ->whereIn('ngayTao', $ngayTaoValues)
            ->whereIn('choan.maLoaiChoAn', $data->maLoaiChoAn)
            ->where('maCon', $maCon)
            ->get();

        return $choan;
    }
}
