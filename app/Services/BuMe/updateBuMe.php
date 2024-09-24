<?php

namespace App\Services\BuMe;

use App\Models\bume;

class updateBuMe
{
    public function handle($request, $id)
    {
        $bume = bume::where('id', $id)->update([
            'trai' => $request->trai,
            'phai' => $request->phai,
        ]);

        return $bume;
    }
}
