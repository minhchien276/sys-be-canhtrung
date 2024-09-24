<?php
namespace App\Services\ChoAn;

use App\Models\choan;

class findChoAn
{
    public function handle($id)
    {
        $choan = choan::where('maChoAn', $id)->get();

        return $choan;
    }
}