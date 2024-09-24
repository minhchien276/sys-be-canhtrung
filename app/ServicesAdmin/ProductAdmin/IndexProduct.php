<?php

namespace App\ServicesAdmin\ProductAdmin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexProduct
{
    public function index()
    {
        $products = DB::table('sanpham')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->select('sanpham.*', 'loaisanpham.name as category_name')
            ->get();

        $products->map(function ($item) {
            if ($item->ngayTao) {
                $ngayTao = Carbon::createFromTimestamp($item->ngayTao / 1000);
                $item->ngayTao = $ngayTao->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.products.index', compact('products'));
    }
}
