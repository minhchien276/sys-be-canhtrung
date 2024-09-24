<?php

namespace App\Services\SanPham;

use Illuminate\Support\Facades\DB;

class getLimitProducts
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

    public function handle($phase)
    {
        $lsp = DB::table('loaisanpham')->whereIn('id', $this->getId($phase))->orderBy('id', 'desc')->get();

        foreach ($lsp as $sanpham) {
            $maloaisanpham = $sanpham->id;
            $tenloaisanpham = $sanpham->name;
            $productDetails = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
                ->join('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
                ->where('sanpham.loaisanpham_id', $sanpham->id)
                ->select('sanpham.*', 'product_detail.id', 'product_detail.price', 'product_detail.sale', 'product_detail.description', 'product_detail.content', 'product_detail.guide', 'product_detail.product_id', 'loaisanpham.name as type', 'loaisanpham.phase')
                ->orderBy('sanpham.ngayTao', 'asc')
                ->take(4)
                ->get();

            if ($productDetails->count() > 0) {
                $result[] = [
                    "maloaisanpham" => $maloaisanpham,
                    "tenloaisanpham" => $tenloaisanpham,
                    "data" => $productDetails,
                ];
            }
        }

        $response = [
            "data" => $result,
            "message" => "San pham get successfully",
            "status" => true
        ];

        return response()->json($response);
    }
}
