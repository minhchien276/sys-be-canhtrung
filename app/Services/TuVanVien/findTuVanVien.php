<?php
namespace App\Services\TuVanVien;

use App\Models\tuvanvien;

class findTuVanVien
{
    public function handle($id)
    {
        $tvv = tuvanvien::find($id);

        return $tvv;
    }
}