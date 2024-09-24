<?php

namespace App\Services\TiemChung;

use App\Models\tiemchung;

class deleteTiemChung
{
    public function handle($id)
    {
        $tiemchung = tiemchung::where('id', $id)->delete();

        return $tiemchung;
    }
}
