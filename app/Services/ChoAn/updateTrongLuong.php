<?php
namespace App\Services\ChoAn;

use App\Models\choan;

class updateTrongLuong
{
    public function handle($request, $maChoAn)
    {
        $choan = choan::where('maChoAn', $maChoAn)->update([
            "trongLuong" => $request->trongLuong,
            "vuTrai" => $request->vuTrai,
            "vuPhai" => $request->vuPhai,
        ]);

        return $choan;
    }
}