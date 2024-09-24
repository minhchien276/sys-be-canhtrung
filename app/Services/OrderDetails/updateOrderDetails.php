<?php
namespace App\Services\OrderDetails;

use App\Models\order_detail;

class updateOrderDetails 
{
    public function handle($request, $id)
    {
        $order_detail = order_detail::where('id', $id)->update([
            "quantity" => $request->quantity,
            "price" => $request->price,
            "id_product_detail" => $request->id_product_detail,
        ]);

        return $order_detail;
    }
}