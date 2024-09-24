<?php

namespace App\Services\Order;

use App\Models\order;

class getOrder
{
    public function handle($id)
    {
        $order = order::where('id', $id)->first();

        return $order;
    }
}
