<?php
namespace App\Services\OrderDetails;

use App\Models\order_detail;

class createOrderDetails 
{
    public function handle($request)
    {
        $order_detail = order_detail::create([
            "quantity" => $request->quantity,
            "price" => $request->price,
            "id_order" => $request->id_order,
            "id_product_detail" => $request->id_product_detail,
            "created_at" => $request->created_at,
        ]);

        return $order_detail;
    }
}