<?php
namespace App\Services\LoaiSanPham;

use App\Models\loaisanpham;

class createLoaiSanPham 
{
    public function handle($request)
    {
        $loaisp = loaisanpham::create([
            "name" => $request->name,
        ]);

        return $loaisp;
    }
}