<?php

namespace App\Services\ChoAn;

use App\Models\choan;

class getChoAnByMaLoaiChoAn
{
    public function handle($maCon, $ngayTao, $request)
    {
        $data = $request;
 

        $choan = choan::join('loaichoan', 'choan.maLoaiChoAn', 'loaichoan.maLoaiChoAn')
            ->select('choan.*', 'loaichoan.tenLoaiChoAn', 'loaichoan.donVi')
            ->where('maCon', $maCon)
            ->whereIn('choan.maLoaiChoAn', $data->maLoaiChoAn)
            ->where('ngayTao', $ngayTao)
            ->orderBy('thoiGian', 'desc')
            ->get();

        return $choan;
    }
}
