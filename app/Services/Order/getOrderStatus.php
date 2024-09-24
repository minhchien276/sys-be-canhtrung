<?php
namespace App\Services\Order;

use Illuminate\Support\Facades\DB;

class getOrderStatus
{
    public function handle($maNguoiDung)
    {
        $order = DB::table('orders')
            ->leftJoin('order_status', 'orders.status', '=', 'order_status.id')
            ->where('orders.maNguoiDung', $maNguoiDung)
            ->where('orders.status', '<=', 3)
            ->select('orders.*', 'order_status.name as name_status')
            ->orderBy('orders.created_at', 'desc')
            ->get();
        
        return $order;
    }
}