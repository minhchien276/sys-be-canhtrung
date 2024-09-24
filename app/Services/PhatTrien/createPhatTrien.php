<?php

namespace App\Services\PhatTrien;

use App\Models\phattrien;

class createPhatTrien
{
    public function handle($request)
    {
        $check = phattrien::where('maCon', $request->maCon)
            ->where('thoiGian', $request->thoiGian)
            ->first();

        if ($check) {
            $phattrien = phattrien::where('id', $check->id)->update([
                "canNang" => $request->canNang,
                "chieuCao" => $request->chieuCao,
            ]);
        } else {
            $phattrien = phattrien::create([
                "maCon" => $request->maCon,
                "canNang" => $request->canNang,
                "chieuCao" => $request->chieuCao,
                "thoiGian" => $request->thoiGian,
            ]);
        }

        $phattrien = phattrien::where('maCon', $request->maCon)
            ->orderBy('thoiGian', 'desc')
            ->get();

        return $phattrien;
    }
}
