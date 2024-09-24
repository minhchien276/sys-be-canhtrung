<?php

namespace App\Services\SanPham;

use Illuminate\Support\Facades\DB;

class searchProducts
{
    public function getId($phase)
    {
        if ($phase == 1) {
            return [4, 7, 15];
        } elseif ($phase == 2) {
            return [4, 7, 18];
        } elseif ($phase == 3) {
            return [7];
        } elseif ($phase == 4) {
            return [10, 7];
        } else {
            return [13];
        }
    }

    public function handle($request, $phase)
    {
        $search = '%' . $request->search . '%';

        $productDetails = DB::table('sanpham')
            ->join('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->join('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
            ->select('sanpham.*', 'product_detail.id', 'product_detail.price', 'product_detail.sale', 'product_detail.description', 'product_detail.content', 'product_detail.guide', 'product_detail.product_id', 'loaisanpham.name as type', 'loaisanpham.phase')
            ->whereIn('sanpham.loaisanpham_id', $this->getId($phase))
            ->where(function ($query) use ($search) {
                $query->where('sanpham.name', 'like', '%' . $search . '%')
                    ->orWhere('sanpham.keyword', 'like', '%' . $search . '%');
            })
            ->orderBy('sanpham.loaisanpham_id', 'desc')
            ->get();


        $response = [
            "data" => $productDetails,
            "message" => "San pham get successfully",
            "status" => true
        ];

        return response()->json($response);
    }
}
