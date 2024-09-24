<?php

namespace App\Services\SanPham;

use Illuminate\Support\Facades\DB;

class getAllProducts
{
    public function handle($maloaisp)
    {
        $productDetails = DB::table('sanpham')
            ->join('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->join('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
            ->where('sanpham.loaisanpham_id', $maloaisp)
            ->select('sanpham.*', 'product_detail.id', 'product_detail.price', 'product_detail.sale', 'product_detail.description', 'product_detail.content', 'product_detail.guide', 'product_detail.product_id', 'loaisanpham.name as type', 'loaisanpham.phase')
            ->get();

        $response = [
            "data" => $productDetails,
            "message" => "San pham get successfully",
            "status" => true
        ];

        return response()->json($response);
    }
}
