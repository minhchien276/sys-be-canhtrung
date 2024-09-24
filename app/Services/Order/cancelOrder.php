<?php
namespace App\Services\Order;

use App\Models\order;

class cancelOrder 
{
    public function handle($id)
    {
        $order = order::where('id', $id)->update([
            "status" => 5,
        ]);

        return $order;
    }
}