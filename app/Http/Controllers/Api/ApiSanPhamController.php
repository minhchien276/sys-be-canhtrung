<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SanPham\createSanPham;
use App\Services\SanPham\deleteSanPham;
use App\Services\SanPham\getAllDetails;
use App\Services\SanPham\getAllProducts;
use App\Services\SanPham\getDetailsByIdProduct;
use App\Services\SanPham\getLimitProducts;
use App\Services\SanPham\getProductDiscount;
use App\Services\SanPham\searchProducts;
use App\Services\SanPham\updateSanPham;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiSanPhamController extends Controller
{
    private $createSanPham;
    private $updateSanPham;
    private $deleteSanPham;
    private $getAllProducts;
    private $getLimitProducts;
    private $getAllDetails;
    private $getDetailsByIdProduct;
    private $searchProducts;
    private $getProductDiscount;

    public function __construct(
        createSanPham $createSanPham,
        updateSanPham $updateSanPham,
        deleteSanPham $deleteSanPham,
        getAllProducts $getAllProducts,
        getLimitProducts $getLimitProducts,
        getAllDetails $getAllDetails,
        getDetailsByIdProduct $getDetailsByIdProduct,
        searchProducts $searchProducts,
        getProductDiscount $getProductDiscount,
    ) {
        $this->middleware('auth:api');
        $this->createSanPham = $createSanPham;
        $this->updateSanPham = $updateSanPham;
        $this->deleteSanPham = $deleteSanPham;
        $this->getAllProducts = $getAllProducts;
        $this->getLimitProducts = $getLimitProducts;
        $this->getAllDetails = $getAllDetails;
        $this->getDetailsByIdProduct = $getDetailsByIdProduct;
        $this->searchProducts = $searchProducts;
        $this->getProductDiscount = $getProductDiscount;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'loaisanpham_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $sanpham = $this->createSanPham->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($sanpham, 'San pham created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'loaisanpham_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $sanpham = $this->updateSanPham->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($sanpham, 'San pham updated successfully');
    }

    public function delete($id)
    {
        try {
            $sanpham = $this->deleteSanPham->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($sanpham, 'San pham deleted successfully');
    }

    public function getAll($maloaisp)
    {
        try {
            $sanpham = $this->getAllProducts->handle($maloaisp);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $sanpham;
    }

    public function getLimit($phase)
    {
        try {
            $sanpham = $this->getLimitProducts->handle($phase);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $sanpham;
    }

    public function getAllDetails(Request $request)
    {
        try {
            $sanpham = $this->getAllDetails->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $sanpham;
    }

    public function getDetailsByIdProduct($id)
    {
        try {
            $sanpham = $this->getDetailsByIdProduct->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $sanpham;
    }

    public function searchProducts(Request $request, $phase)
    {
        try {
            $sanpham = $this->searchProducts->handle($request, $phase);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $sanpham;
    }

    public function getProductDiscount()
    {
        return $this->getProductDiscount->handle();
    }
}
