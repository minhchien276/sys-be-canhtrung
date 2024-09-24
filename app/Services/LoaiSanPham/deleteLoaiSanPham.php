<?php
namespace App\Services\LoaiSanPham;

use App\Models\loaisanpham;

class deleteLoaiSanPham 
{
    public function handle($id)
    {
        $loaisp = loaisanpham::where('id', $id)->delete();

        return $loaisp;
    }
}