<?php
namespace App\Services\LoaiChoAn;

use App\Models\loaichoan;

class createLoaiChoAn
{
    public function handle($request)
    {
        $loaichoan = loaichoan::create([
            "tenLoaiChoAn" => $request->tenLoaiChoAn,
            "donVi" => $request->donVi,
        ]);

        return $loaichoan;
    }
}