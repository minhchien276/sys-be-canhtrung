<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoaiTvv\createLoaiTvv;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLoaiTvvController extends Controller
{
    private $createLoaiTvv;

    public function __construct(
        createLoaiTvv $createLoaiTvv
    ){
        $this->middleware('auth:api');
        $this->createLoaiTvv = $createLoaiTvv;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $loaiTvv = $this->createLoaiTvv->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaiTvv, 'create loai Tvv successfully');
    }
}
