<?php

namespace App\Services\AnDam;

use App\Models\andam;

class updateAnDam
{
    public function handle($request, $id)
    {
        $andam = andam::where('id', $id)->update([
            'loaiThucPham' => $request->loaiThucPham,
            'trongLuong' => $request->trongLuong,
        ]);

        return $andam;
    }
}
