<?php

namespace App\Services\TuVanVien;

use App\Models\tuvanvien;
use App\Models\tvv_nguoidung;
use Illuminate\Support\Facades\DB;

class getTvvByIdUser
{
    public function handle($id, $id_loaitvv)
    {
        $tvv = DB::table('tvv_nguoidung')
            ->join('tuvanvien', 'tvv_nguoidung.maTvv', '=', 'tuvanvien.maTvv')
            ->select('tuvanvien.*')
            ->where('tvv_nguoidung.maNguoiDung', $id)
            ->where('tuvanvien.id_loaitvv', $id_loaitvv)
            ->get();

        if ($tvv->isEmpty()) {
            $data = tuvanvien::get();
            return $data;
        }

        return $tvv;
    }
}
