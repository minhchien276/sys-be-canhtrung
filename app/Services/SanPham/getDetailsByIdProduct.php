<?php

namespace App\Services\SanPham;

use Illuminate\Support\Facades\DB;

class getDetailsByIdProduct
{
    public function handle($id)
    {
        $productDetails = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->leftJoin('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
            ->where('sanpham.id', $id)
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
