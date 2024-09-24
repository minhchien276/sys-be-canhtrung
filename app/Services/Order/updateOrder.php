<?php
namespace App\Services\Order;

use App\Models\order;

class updateOrder 
{
    public function handle($id)
    {
        $order = order::where('id', $id)->update([
            "user_payed" => 1,
        ]);

        return $order;
    }
}