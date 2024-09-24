<?php

namespace App\Services\BuBinh;

use App\Models\bubinh;

class createBuBinh
{
    public function handle($request)
    {
        $bubinh = bubinh::create([
            'suaCongThuc' => $request->suaCongThuc,
            'suaMe' => $request->suaMe,
            'id_con' => $request->id_con,
        ]);

        return $bubinh;
    }
}
