<?php

namespace App\Services\ChoAn;

use App\Models\choan;

class getChoAn
{
    public function handle($maCon, $ngayTao)
    {
        $choan = choan::join('loaichoan', 'choan.maLoaiChoAn', 'loaichoan.maLoaiChoAn')
            ->select('choan.*', 'loaichoan.tenLoaiChoAn', 'loaichoan.donVi')
            ->where('maCon', $maCon)
            ->where('ngayTao', $ngayTao)
            ->orderBy('thoiGian', 'asc')
            ->get();

        return $choan;
    }
}
