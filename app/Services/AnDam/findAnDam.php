<?php

namespace App\Services\AnDam;

use App\Models\andam;

class findAnDam
{
    public function handle($id)
    {
        $andam = andam::find($id);

        return $andam;
    }
}
