<?php

namespace App\Services\BuMe;

use App\Models\bume;

class createBuMe
{
    public function handle($request)
    {
        $bume = bume::create([
            'trai' => $request->trai,
            'phai' => $request->phai,
            'id_con' => $request->id_con,
        ]);

        return $bume;
    }
}
