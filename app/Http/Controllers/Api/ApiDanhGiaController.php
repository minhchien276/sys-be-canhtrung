<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DanhGia\createDanhGia;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiDanhGiaController extends Controller
{
    private $createDanhGia;

    public function __construct(
        createDanhGia $createDanhGia
    ){
        $this->middleware('auth:api');
        $this->createDanhGia = $createDanhGia;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_nguoidung' => 'required',
            'id_tvv' => 'required',
            'danhgia' => 'required',
            'sao' => 'required|numeric',
            'thoiGian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }
        
        try {
            $danhgia = $this->createDanhGia->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($danhgia, 'created danh gia successfully');
    }
}
