<?php
namespace App\Services\Benh;

use App\Models\benh;

class deleteBenh 
{
    public function handle($id)
    {
        $benh = benh::where('id', $id)->delete();

        return $benh;
    }
}