<?php

namespace App\Services\TiemChung;

use App\Models\tiemchung;

class getTiemChung
{
    public function handle($id_con, $id_vacxin)
    {
        $tiemchung = tiemchung::where('id_con', $id_con)->where('id_vacxin', $id_vacxin)->get();

        return $tiemchung;
    }
}
