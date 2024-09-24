<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LuongKinh\createLuongKinh;
use App\Services\LuongKinh\deleteLuongKinh;
use App\Services\LuongKinh\dongBoLuongKinh;
use App\Services\LuongKinh\findLuongKinh;
use App\Services\LuongKinh\getLuongKinh;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLuongKinhController extends Controller
{
    private $createLuongKinh;
    private $findLuongKinh;
    private $getLuongKinh;
    private $deleteLuongKinh;
    private $dongBoLuongKinh;

    public function __construct(
        createLuongKinh $createLuongKinh,
        findLuongKinh $findLuongKinh,
        getLuongKinh $getLuongKinh,
        deleteLuongKinh $deleteLuongKinh,
        dongBoLuongKinh $dongBoLuongKinh,
    ) {
        $this->middleware('auth:api');
        $this->createLuongKinh = $createLuongKinh;
        $this->findLuongKinh = $findLuongKinh;
        $this->getLuongKinh = $getLuongKinh;
        $this->deleteLuongKinh = $deleteLuongKinh;
        $this->dongBoLuongKinh = $dongBoLuongKinh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'luongKinh' => 'required',
            'thoiGian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $luongkinh = $this->createLuongKinh->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($luongkinh, 'LuongKinh created successfully');
    }

    public function find($id)
    {
        try {
            $luongkinh = $this->findLuongKinh->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($luongkinh, 'Luongkinh find successful');
    }

    public function getluongKinh($maNguoiDung, $thoiGian)
    {
        try {
            $luongkinh = $this->getLuongKinh->handle($maNguoiDung, $thoiGian);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($luongkinh, 'luongkinh get successfully');
    }

    public function delete($id)
    {
        try {
            $luongkinh = $this->deleteLuongKinh->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($luongkinh, 'LuongKinh deleted successfully');
    }

    public function dongBoLuongKinh(Request $request, $maNguoiDung)
    {
        return $this->dongBoLuongKinh->handle($request, $maNguoiDung);
    }
}
