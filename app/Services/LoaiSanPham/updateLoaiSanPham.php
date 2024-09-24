<?php
namespace App\Services\LoaiSanPham;

use App\Models\loaisanpham;

class updateLoaiSanPham 
{
    public function handle($request, $id)
    {
        $loaisp = loaisanpham::where('id', $id)->update([
            "name" => $request->name,
        ]);

        return $loaisp;
    }
}