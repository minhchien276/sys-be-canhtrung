<?php

namespace App\Services\TaiLieuKichSua;

use App\Models\tailieukichsua;

class getImage
{
    public function handle()
    {
        $tailieukichsua = tailieukichsua::where('type', 0)->orderBy('created_at', 'desc')->get();

        return $tailieukichsua;
    }
}
