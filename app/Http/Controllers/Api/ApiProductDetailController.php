<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductDetail\createProductDetail;
use App\Services\ProductDetail\deleteProductDetail;
use App\Services\ProductDetail\getByIdProduct;
use App\Services\ProductDetail\updateProductDetail;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductDetailController extends Controller
{
    private $createProductDetail;
    private $updateProductDetail;
    private $getByIdProduct;
    private $deleteProductDetail;

    public function __construct(
        createProductDetail $createProductDetail,
        updateProductDetail $updateProductDetail,
        deleteProductDetail $deleteProductDetail,
        getByIdProduct $getByIdProduct,
    ) {
        $this->middleware('auth:api');
        $this->createProductDetail = $createProductDetail;
        $this->updateProductDetail = $updateProductDetail;
        $this->deleteProductDetail = $deleteProductDetail;
        $this->getByIdProduct = $getByIdProduct;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'price' => 'required',
            'sale' => 'required',
            'description' => 'required',
            'content' => 'required',
            'guide' => 'required',
            'product_id' => 'required',
            'created_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $product_detail = $this->createProductDetail->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($product_detail, 'Product detail created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'price' => 'required',
            'sale' => 'required',
            'description' => 'required',
            'content' => 'required',
            'guide' => 'required',
            'product_id' => 'required',
            'created_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $product_detail = $this->updateProductDetail->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($product_detail, 'Product detail update successfully');
    }

    public function getByProductId($product_id)
    {
        try {
            $product_detail = $this->getByIdProduct->handle($product_id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($product_detail, 'Product detail get successfully');
    }

    public function delete($id)
    {
        try {
            $product_detail = $this->deleteProductDetail->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($product_detail, 'Product detail deleted successfully');
    }
}
