<?php
namespace App\Services\OrderDetails;

use App\Models\order_detail;

class deleteOrderDetails 
{
    public function handle($id)
    {
        $order_detail = order_detail::where('id', $id)->delete();

        return $order_detail;
    }
}