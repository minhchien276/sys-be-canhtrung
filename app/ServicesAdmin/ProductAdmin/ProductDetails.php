<?php

namespace App\ServicesAdmin\ProductAdmin;

use App\Models\product_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductDetails
{
    public function productDetails($id)
    {
        $product_id = $id;

        $productDetails = DB::table('product_detail')
            ->leftJoin('sanpham', 'product_detail.product_id', '=', 'sanpham.id')
            ->where('product_detail.product_id', $id)
            ->select('product_detail.*')
            ->get();

        return view('admin.products.productDetails', compact('productDetails', 'product_id'));
    }

    public function editProductDetails($id)
    {
        $productDetails = DB::table('product_detail')
            ->leftJoin('sanpham', 'product_detail.product_id', '=', 'sanpham.id')
            ->where('product_detail.id', $id)
            ->select('product_detail.*')
            ->first();

        return view('admin.products.storeOrUpdateDetails', compact('productDetails'));
    }

    public function updateOrInsert($request, $id)
    {
        $created_at = Carbon::now()->format('d-m-Y H:i:s');

        $milliseconds = strtotime($created_at) * 1000;

        product_detail::updateOrInsert(
            ['product_id' => $id],
            [
                'product_id' => $id,
                'image' => $request->image,
                'price' => $request->price,
                'sale' => $request->sale,
                'description' => $request->description,
                'content' => $request->content,
                'guide' => $request->guide,
                'created_at' => $milliseconds,
            ]
        );

        $productDetails = DB::table('product_detail')
            ->leftJoin('sanpham', 'product_detail.product_id', '=', 'sanpham.id')
            ->where('product_detail.product_id', $id)
            ->select('product_detail.*')
            ->get();

        return view('admin.products.productDetails', compact('productDetails'));
    }

    public function createProductDetails($request)
    {
        $product_id = $request->id;

        return view('admin.products.createProductDetails', compact('product_id'));
    }

    public function storeDetail($request)
    {
        $created_at = Carbon::now()->format('d-m-Y H:i:s');

        $milliseconds = strtotime($created_at) * 1000;

        product_detail::create(
            [
                'image' => $request->image,
                'price' => $request->price,
                'sale' => $request->sale,
                'description' => $request->description,
                'content' => $request->content,
                'guide' => $request->guide,
                'created_at' => $milliseconds,
                'product_id' => $request->product_id,
            ]
        );

        $productDetails = DB::table('product_detail')
            ->leftJoin('sanpham', 'product_detail.product_id', '=', 'sanpham.id')
            ->where('product_detail.product_id', $request->product_id)
            ->select('product_detail.*')
            ->get();

        return view('admin.products.productDetails', compact('productDetails'));
    }
}
