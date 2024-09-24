<?php

namespace App\Services\BuMe;

use App\Models\bume;

class deleteBuMe
{
    public function handle($id)
    {
        $bume = bume::where('id', $id)->delete();

        return $bume;
    }
}
