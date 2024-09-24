<?php

namespace App\Services\Connnnn;

use App\Models\connnnn;
use Illuminate\Support\Facades\DB;

class createConnnnn
{
    public function handle($request)
    {
        $connnnn = connnnn::create([
            "ten" => $request->ten,
            "ngaySinh" => $request->ngaySinh,
            "gioiTinh" => $request->gioiTinh,
            "maNguoiDung" => $request->maNguoiDung,
            "trangThai" => 1,
            "thoiGian" => $request->thoiGian,
        ]);

        if ($connnnn) {
            DB::table('connnnn')
                ->where('maNguoiDung', $connnnn->maNguoiDung)
                ->where('id', '<>', $connnnn->id)
                ->update(['trangThai' => 0]);
        }

        return $connnnn;
    }
}
