<?php
namespace App\Services\ChoAn;

use App\Models\choan;

class deleteChoAn
{
    public function handle($id)
    {
        $choan = choan::where('maChoAn', $id)->delete();

        return $choan;
    }
}