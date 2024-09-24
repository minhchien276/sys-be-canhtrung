<?php

namespace App\ServicesAdmin\ProductAdmin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductDiscount
{
    public function discounting()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->leftJoin('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->whereColumn('product_detail.price', '!=', 'product_detail.sale')
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.discount', compact('products'));
    }
}
