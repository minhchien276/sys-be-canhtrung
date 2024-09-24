<?php

namespace App\Services\SanPham;

use App\Supports\Responder;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class getProductDiscount
{
    public function handle()
    {
        try {
            $productDetails = DB::table('sanpham')
                ->join('loaisanpham', 'sanpham.loaisanpham_id', '=', 'loaisanpham.id')
                ->join('product_detail', 'sanpham.id', '=', 'product_detail.product_id')
                ->whereColumn('product_detail.sale', '!=', 'product_detail.price')
                ->select('sanpham.*', 'product_detail.id', 'product_detail.price', 'product_detail.sale', 'product_detail.description', 'product_detail.content', 'product_detail.guide', 'product_detail.product_id', 'loaisanpham.name as type', 'loaisanpham.phase')
                ->get();

            if ($productDetails->isEmpty()) {
                return Responder::fail(null, 'Không có sản phẩm nào đang khuyến mãi');
            }

            return Responder::success($productDetails, 'Danh sách sản phẩm đang khuyến mãi');
        } catch (QueryException $e) {
            return Responder::fail($e->getMessage(), 'Lỗi truy vấn cơ sở dữ liệu');
        } catch (Exception $e) {
            return Responder::fail($e->getMessage(), 'Đã xảy ra lỗi');
        }
    }
}
