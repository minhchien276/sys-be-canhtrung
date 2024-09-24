<?php
namespace App\Services\LoaiChoAn;

use App\Models\loaichoan;

class updateLoaiChoAn
{
    public function handle($request, $id)
    {
        $loaichoan = loaichoan::where('maLoaiChoAn', $id)->update([
            "tenLoaiChoAn" => $request->tenLoaiChoAn,
            "donVi" => $request->donVi,
        ]);

        return $loaichoan;
    }
}