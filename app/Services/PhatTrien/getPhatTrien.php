<?php

namespace App\Services\PhatTrien;

use App\Models\phattrien;

class getPhatTrien
{
    public function handle($maCon)
    {
        $phattrien = phattrien::where('maCon', $maCon)
            ->orderBy('thoiGian', 'desc')
            ->get();

        return $phattrien;
    }
}
