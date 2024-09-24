<?php
namespace App\Services\SanPham;

use App\Models\sanpham;

class createSanPham 
{
    public function handle($request)
    {
        $sanpham = sanpham::create([
            "name" => $request->name,
            "image" => $request->image,
            "loaisanpham_id" => $request->loaisanpham_id,
            "ngayTao" => $request->ngayTao,
        ]);

        return $sanpham;
    }
}