<?php
namespace App\Services\ProductDetail;

use App\Models\product_detail;

class createProductDetail 
{
    public function handle($request)
    {
        $product_detail = product_detail::create([
            "image" => $request->image,
            "price" => $request->price,
            "sale" => $request->sale,
            "description" => $request->description,
            "content" => $request->content,
            "guide" => $request->guide,
            "product_id" => $request->product_id,
            "created_at" => $request->created_at,
        ]);

        return $product_detail;
    }
}