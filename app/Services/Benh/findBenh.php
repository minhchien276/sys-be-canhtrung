<?php
namespace App\Services\Benh;

use App\Models\benh;

class findBenh 
{
    public function handle($id)
    {
        $benh = benh::find($id);

        return $benh;
    }
}