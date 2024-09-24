<?php
namespace App\Services\CauHoi;

use App\Models\cauhoi;

class deleteCauHoi
{
    public function handle($id)
    {
        $cauhoi = cauhoi::where('maCauHoi', $id)->delete();

        return $cauhoi;
    }
}