<?php

namespace App\Services\TiemChung;

use App\Models\tiemchung;

class createTiemChung
{
    public function handle($request)
    {
        $tiemchung = tiemchung::create([
            'id_vacxin' => $request->id_vacxin,
            'lanTiem' => $request->lanTiem,
            'thoiGian' => $request->thoiGian,
            'id_con' => $request->id_con,
        ]);
    
        return $tiemchung;
    }
}
