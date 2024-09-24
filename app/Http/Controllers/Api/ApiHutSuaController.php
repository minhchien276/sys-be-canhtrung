<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HutSua\createHutSua;
use App\Services\HutSua\deleteHutSua;
use App\Services\HutSua\findHutSua;
use App\Services\HutSua\get7Ngay;
use App\Services\HutSua\getHutSuaByNgayTao;
use App\Services\HutSua\updateHutSua;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiHutSuaController extends Controller
{
    private $createHutSua;
    private $updateHutSua;
    private $findHutSua;
    private $deleteHutSua;
    private $getHutSuaByNgayTao;
    private $get7Ngay;

    public function __construct(
        createHutSua $createHutSua,
        updateHutSua $updateHutSua,
        findHutSua $findHutSua,
        deleteHutSua $deleteHutSua,
        getHutSuaByNgayTao $getHutSuaByNgayTao,
        get7Ngay $get7Ngay,
    ){
        $this->middleware('auth:api');
        $this->createHutSua = $createHutSua;
        $this->updateHutSua = $updateHutSua;
        $this->findHutSua = $findHutSua;
        $this->deleteHutSua = $deleteHutSua;
        $this->getHutSuaByNgayTao = $getHutSuaByNgayTao;
        $this->get7Ngay = $get7Ngay;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'lanChoAn' => 'required|numeric',
            'thoiGian' => 'required|numeric',
            'ngayTao' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }
        
        try {
            $hutsua = $this->createHutSua->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'created hut sua successfully');
    }

    public function update(Request $request, $id)
    {   
        try {
            $hutsua = $this->updateHutSua->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'updated hut sua successfully');
    }

    public function find($id)
    {
        try {
            $hutsua = $this->findHutSua->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'find hut sua successfully');
    }

    public function delete($id)
    {
        try {
            $hutsua = $this->deleteHutSua->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'delete hut sua successfully');
    }

    public function getHutSuaByNgayTao($maNguoiDung, $ngayTao)
    {
        try {
            $hutsua = $this->getHutSuaByNgayTao->handle($maNguoiDung, $ngayTao);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'get hut sua by ngay tao successfully');
    }

    public function getHutSua7Ngay($maNguoiDung)
    {
        try {
            $hutsua = $this->get7Ngay->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hutsua, 'get hut sua by ngay tao successfully');
    }
}
