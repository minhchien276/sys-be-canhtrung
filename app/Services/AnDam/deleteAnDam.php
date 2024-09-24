<?php

namespace App\Services\AnDam;

use App\Models\andam;

class deleteAnDam
{
    public function handle($id)
    {
        $andam = andam::where('id', $id)->delete();

        return $andam;
    }
}
