<?php
namespace App\Services\TuVanVien;

use App\Models\tuvanvien;

class deleteTuVanVien
{
    public function handle($id)
    {
        $tvv = tuvanvien::find($id)->delete();

        return $tvv;
    }
}