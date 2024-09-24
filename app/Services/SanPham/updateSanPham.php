<?php
namespace App\Services\SanPham;

use App\Models\sanpham;

class updateSanPham 
{
    public function handle($request, $id)
    {
        $sanpham = sanpham::where('id', $id)->update([
            "name" => $request->name,
            "image" => $request->image,
            "loaisanpham_id" => $request->loaisanpham_id,
            "ngayTao" => $request->ngayTao,
        ]);

        return $sanpham;
    }
}