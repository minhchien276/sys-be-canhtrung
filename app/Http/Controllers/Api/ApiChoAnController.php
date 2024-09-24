<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ChoAn\createChoAn;
use App\Services\ChoAn\deleteChoAn;
use App\Services\ChoAn\findChoAn;
use App\Services\ChoAn\getChoAn;
use App\Services\ChoAn\getChoAnByMaLoaiChoAn;
use App\Services\ChoAn\getNgayTao;
use App\Services\ChoAn\updateChoAn;
use App\Services\ChoAn\updateTrongLuong;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiChoAnController extends Controller
{
    private $createChoAn;
    private $updateChoAn;
    private $deleteChoAn;
    private $findChoAn;
    private $getChoAn;
    private $getChoAnByMaLoaiChoAn;
    private $getNgayTao;
    private $updateTrongLuong;

    public function __construct(
        createChoAn $createChoAn,
        updateChoAn $updateChoAn,
        deleteChoAn $deleteChoAn,
        findChoAn $findChoAn,
        getChoAn $getChoAn,
        getChoAnByMaLoaiChoAn $getChoAnByMaLoaiChoAn,
        getNgayTao $getNgayTao,
        updateTrongLuong $updateTrongLuong,
    ){
        $this->middleware('auth:api');
        $this->createChoAn = $createChoAn;
        $this->updateChoAn = $updateChoAn;
        $this->deleteChoAn = $deleteChoAn;
        $this->findChoAn = $findChoAn;
        $this->getChoAn = $getChoAn;
        $this->getChoAnByMaLoaiChoAn = $getChoAnByMaLoaiChoAn;
        $this->getNgayTao = $getNgayTao;
        $this->updateTrongLuong = $updateTrongLuong;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maLoaiChoAn' => 'required',
            'maCon' => 'required',
            'trongLuong' => 'required|numeric',
            'lanChoAn' => 'required|numeric',
            'thoiGian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $choan = $this->createChoAn->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'maLoaiChoAn' => 'required',
            'maCon' => 'required',
            'trongLuong' => 'required|numeric',
            'lanChoAn' => 'required|numeric',
            'thoiGian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $choan = $this->updateChoAn->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an updated successfully');
    }

    public function delete($id)
    {
        try {
            $choan = $this->deleteChoAn->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an deleted successfully');
    }

    public function find($id)
    {
        try {
            $choan = $this->findChoAn->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an find successfully');
    }

    public function getChoAn($maCon, $ngayTao)
    {
        try {
            $choan = $this->getChoAn->handle($maCon, $ngayTao);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an get successfully');
    }

    public function getChoAnByMaLoaiChoAn($maCon, $ngayTao, Request $request)
    {
        try {
            $choan = $this->getChoAnByMaLoaiChoAn->handle($maCon, $ngayTao, $request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an get successfully');
    }

    public function getChoAnByNgayTao($maCon, Request $request)
    {
        try {
            $choan = $this->getNgayTao->handle($maCon, $request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'cho an get successfully');
    }

    public function updateTrongLuong($maChoAn, Request $request)
    {
        try {
            $choan = $this->updateTrongLuong->handle($request, $maChoAn);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($choan, 'trong luong update successfully');
    }
}
