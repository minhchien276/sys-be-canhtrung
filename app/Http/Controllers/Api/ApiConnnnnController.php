<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Connnnn\createConnnnn;
use App\Services\Connnnn\deleteConnnnn;
use App\Services\Connnnn\findConnnnn;
use App\Services\Connnnn\getConByMaNguoiDung;
use App\Services\Connnnn\getConByTrangThai;
use App\Services\Connnnn\updateConnnnn;
use App\Services\Connnnn\updateTrangThai;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiConnnnnController extends Controller
{
    private $createConnnnn;
    private $updateConnnnn;
    private $findConnnnn;
    private $deleteConnnnn;
    private $getConByMaNguoiDung;
    private $getConByTrangThai;
    private $updateTrangThai;

    public function __construct(
        createConnnnn $createConnnnn,
        updateConnnnn $updateConnnnn,
        findConnnnn $findConnnnn,
        deleteConnnnn $deleteConnnnn,
        getConByMaNguoiDung $getConByMaNguoiDung,
        getConByTrangThai $getConByTrangThai,
        updateTrangThai $updateTrangThai,
    ) {
        $this->middleware('auth:api');
        $this->createConnnnn = $createConnnnn;
        $this->updateConnnnn = $updateConnnnn;
        $this->findConnnnn = $findConnnnn;
        $this->deleteConnnnn = $deleteConnnnn;
        $this->getConByMaNguoiDung = $getConByMaNguoiDung;
        $this->getConByTrangThai = $getConByTrangThai;
        $this->updateTrangThai = $updateTrangThai;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ten' => 'required',
            'ngaySinh' => 'required|numeric',
            'gioiTinh' => 'required',
            'maNguoiDung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $connnnn = $this->createConnnnn->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($connnnn, 'connnnn created successfully');
    }

    public function update(Request $request, $id)
    {
        return $this->updateConnnnn->handle($request, $id);
    }

    public function find($id)
    {
        try {
            $connnnn = $this->findConnnnn->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($connnnn, 'connnnn find successfully');
    }

    public function delete($id, $maNguoiDung)
    {
        try {
            $connnnn = $this->deleteConnnnn->handle($id, $maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return  $connnnn;
    }

    public function getConByMaNguoiDung($id)
    {
        try {
            $connnnn = $this->getConByMaNguoiDung->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($connnnn, 'connnnn get successfully');
    }

    public function getConByTrangThai($id)
    {
        try {
            $connnnn = $this->getConByTrangThai->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($connnnn, 'connnnn get successfully');
    }

    public function updateTrangThai($id, $maNguoiDung)
    {
        try {
            $connnnn = $this->updateTrangThai->handle($id, $maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($connnnn, 'trangthai updated successfully');
    }
}
