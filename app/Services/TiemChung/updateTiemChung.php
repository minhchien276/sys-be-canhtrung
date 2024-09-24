<?php

namespace App\Services\TiemChung;

use App\Models\tiemchung;

class updateTiemChung
{
    public function handle($request, $id_con, $id_vacxin)
    {
        $tiemchung = tiemchung::where('id_con', $id_con)
            ->where('id_vacxin', $id_vacxin)
            ->update([
                'lanTiem' => $request->lanTiem,
                'thoiGian' => $request->thoiGian,
            ]);

        return $tiemchung;
    }
}
