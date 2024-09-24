<?php
namespace App\Services\ProductDetail;

use App\Models\product_detail;

class getByIdProduct 
{
    public function handle($product_id)
    {
        $product_detail = product_detail::where('product_id',  $product_id)->get();

        return $product_detail;
    }
}