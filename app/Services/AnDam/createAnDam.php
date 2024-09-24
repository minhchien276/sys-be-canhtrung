<?php

namespace App\Services\AnDam;

use App\Models\andam;

class createAnDam
{
    public function handle($request)
    {
        $andam = andam::create([
            'loaiThucPham' => $request->loaiThucPham,
            'trongLuong' => $request->trongLuong,
            'id_con' => $request->id_con,
        ]);

        return $andam;
    }
}
