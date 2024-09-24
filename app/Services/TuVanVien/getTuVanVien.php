<?php
namespace App\Services\TuVanVien;

use App\Models\tuvanvien;

class getTuVanVien
{
    public function handle($id_loaitvv)
    {
        $tvv = tuvanvien::where('id_loaitvv', $id_loaitvv)->get();

        return $tvv;
    }
}