<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoaiSanPham\createLoaiSanPham;
use App\Services\LoaiSanPham\deleteLoaiSanPham;
use App\Services\LoaiSanPham\updateLoaiSanPham;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLoaiSanPhamController extends Controller
{
    private $createLoaiSanPham;
    private $updateLoaiSanPham;
    private $deleteLoaiSanPham;

    public function __construct(
        createLoaiSanPham $createLoaiSanPham,
        updateLoaiSanPham $updateLoaiSanPham,
        deleteLoaiSanPham $deleteLoaiSanPham,
    ){
        $this->middleware('auth:api');
        $this->createLoaiSanPham = $createLoaiSanPham;
        $this->updateLoaiSanPham = $updateLoaiSanPham;
        $this->deleteLoaiSanPham = $deleteLoaiSanPham;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $loaisp = $this->createLoaiSanPham->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaisp, 'loai san pham created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $loaisp = $this->updateLoaiSanPham->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaisp, 'loai san pham updated successfully');
    }

    public function delete($id)
    {
        try {
            $loaisp = $this->deleteLoaiSanPham->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaisp, 'loai san pham deleted successfully');
    }
}
