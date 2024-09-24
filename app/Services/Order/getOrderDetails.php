<?php

namespace App\Services\Order;

use App\Models\order;
use Illuminate\Support\Facades\DB;

class getOrderDetails
{
    public function handle($id)
    {
        $order = DB::table('order_detail')
            ->leftJoin('orders', 'orders.id', '=', 'order_detail.id_order')
            ->leftJoin('product_detail', 'product_detail.id', '=', 'order_detail.id_product_detail')
            ->leftJoin('sanpham', 'sanpham.id', '=', 'product_detail.product_id')
            ->leftJoin('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
            ->where('orders.id', $id)
            ->select('sanpham.name', 'sanpham.image', 'loaisanpham.name as type', 'product_detail.sale', 'order_detail.quantity')
            ->get();

        return $order;
    }
}
