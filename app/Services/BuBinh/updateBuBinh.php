<?php

namespace App\Services\BuBinh;

use App\Models\bubinh;

class updateBuBinh
{
    public function handle($request, $id)
    {
        $bubinh = bubinh::where('id', $id)->update([
            'suaCongThuc' => $request->suaCongThuc,
            'suaMe' => $request->suaMe,
        ]);

        return $bubinh;
    }
}
