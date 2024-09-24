<?php
namespace App\Services\LoaiChoAn;

use App\Models\loaichoan;

class findLoaiChoAn
{
    public function handle($id)
    {
        $loaichoan = loaichoan::where('maLoaiChoAn', $id)->get();

        return $loaichoan;
    }
}