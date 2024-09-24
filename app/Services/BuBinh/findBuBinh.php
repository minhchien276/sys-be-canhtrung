<?php

namespace App\Services\BuBinh;

use App\Models\bubinh;

class findBuBinh
{
    public function handle($id)
    {
        $bubinh = bubinh::find($id);

        return $bubinh;
    }
}
