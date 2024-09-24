<?php
namespace App\Services\ProductDetail;

use App\Models\product_detail;

class updateProductDetail 
{
    public function handle($request, $id)
    {
        $product_detail = product_detail::where('id',  $id)->update([
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