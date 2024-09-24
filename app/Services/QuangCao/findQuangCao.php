<?php

namespace App\Services\QuangCao;

use App\Models\quangcao;

class findQuangCao
{
    public function handle($phase, $type)
    {
        $quangcao = quangcao::where('phase', $phase)->where('type', $type)->where('status', 1)->first();

        return $quangcao;
    }
}
