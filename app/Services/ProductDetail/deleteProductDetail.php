<?php
namespace App\Services\ProductDetail;

use App\Models\product_detail;

class deleteProductDetail 
{
    public function handle($id)
    {
        $product_detail = product_detail::where('id',  $id)->delete();

        return $product_detail;
    }
}