<?php
namespace App\Services\LoaiChoAn;

use App\Models\loaichoan;

class deleteLoaiChoAn
{
    public function handle($id)
    {
        $loaichoan = loaichoan::where('maLoaiChoAn', $id)->delete();

        return $loaichoan;
    }
}