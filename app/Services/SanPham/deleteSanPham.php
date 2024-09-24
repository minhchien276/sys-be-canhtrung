<?php
namespace App\Services\SanPham;

use App\Models\sanpham;

class deleteSanPham 
{
    public function handle($id)
    {
        $sanpham = sanpham::where('id', $id)->delete();

        return $sanpham;
    }
}