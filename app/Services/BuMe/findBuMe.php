<?php

namespace App\Services\BuMe;

use App\Models\bume;

class findBuMe

{
    public function handle($id)
    {
        $bume = bume::find($id);

        return $bume;
    }
}
