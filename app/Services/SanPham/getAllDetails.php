<?php

namespace App\Services\SanPham;

use Illuminate\Support\Facades\DB;

class getAllDetails
{
    public function handle($request)
    {
        $data = $request->data;
        
        $productDetails = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->leftJoin('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
            ->whereIn('sanpham.id', $data)
            ->orderBy(DB::raw('FIELD(sanpham.id, ' . implode(',', $data) . ')'))
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
