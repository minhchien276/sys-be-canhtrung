<?php

namespace App\Services\QuangCao;

use App\Models\quangcao;

class deleteQuangCao
{
    public function handle($id)
    {
        $quangcao = quangcao::where('id', $id)->delete();

        return $quangcao;
    }
}
