<?php
namespace App\Services\Order;

use App\Models\order;

class deleteOrder 
{
    public function handle($id)
    {
        $order = order::where('id', $id)->delete();
        
        return $order;
    }
}