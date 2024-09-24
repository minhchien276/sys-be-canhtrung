<?php

namespace App\Services\HutSua;

use App\Models\hutsua;
use Illuminate\Support\Facades\DB;

class get7Ngay
{
    public function handle($maNguoiDung)
    {
        $ngayTaoRecords = DB::table('hutsua')
            ->select('ngayTao')
            ->where('maNguoiDung', $maNguoiDung)
            ->distinct()
            ->orderBy('ngayTao', 'desc')
            ->take(7)
            ->get();

        $ngayTaoValues = $ngayTaoRecords->pluck('ngayTao')->toArray();

        $hutsua = hutsua::whereIn('ngayTao', $ngayTaoValues)
            ->where('maNguoiDung', $maNguoiDung)
            ->orderBy('ngayTao', 'asc')
            ->get();

        return $hutsua;
    }
}
