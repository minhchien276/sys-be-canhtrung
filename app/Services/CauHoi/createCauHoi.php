<?php
namespace App\Services\CauHoi;

use App\Models\cauhoi;

class createCauHoi
{
    public function handle($request)
    {
        $cauhoi = cauhoi::create([
            'maCauHoi' => $request->maCauHoi,
            'noiDung' => $request->noiDung,
        ]);

        return $cauhoi;
    }
}