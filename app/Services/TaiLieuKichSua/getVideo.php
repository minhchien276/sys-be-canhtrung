<?php

namespace App\Services\TaiLieuKichSua;

use App\Models\tailieukichsua;

class getVideo
{
    public function handle()
    {
        $tailieukichsua = tailieukichsua::where('type', 1)->orderBy('created_at', 'desc')->get();

        return $tailieukichsua;
    }
}
