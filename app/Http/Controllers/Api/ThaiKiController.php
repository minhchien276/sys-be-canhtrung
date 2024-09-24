<?php

namespace App\Http\Controllers\Api;

use App\Services\ThaiKi\createThaiKi;
use App\Services\ThaiKi\findThaiKi;
use App\Services\ThaiKi\updateThaiKi;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\ThaiKi\deleteNgayDuSinh;

class ThaiKiController extends Controller
{
    private $createThaiKi;
    private $updateThaiKi;
    private $findThaiKi;
    private $deleteNgayDuSinh;

    public function __construct(
        createThaiKi $createThaiKi,
        updateThaiKi $updateThaiKi,
        findThaiKi $findThaiKi,
        deleteNgayDuSinh $deleteNgayDuSinh,
    ){
        $this->middleware('auth:api');
        $this->createThaiKi = $createThaiKi;
        $this->updateThaiKi = $updateThaiKi;
        $this->findThaiKi = $findThaiKi;
        $this->deleteNgayDuSinh = $deleteNgayDuSinh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'ngayDuSinh' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $thaiki = $this->createThaiKi->handle($request);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($thaiki, 'thaiki created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ngayDuSinh' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $thaiki = $this->updateThaiKi->handle($request, $id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($thaiki, 'thaiki updated successfully');
    }

    public function find($id)
    {
        try {
            $thaiki = $this->findThaiKi->handle($id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($thaiki, 'thaiki find successfully');
    }

    public function deleteNgayDuSinh($id)
    {
        try {
            $thaiki = $this->deleteNgayDuSinh->handle($id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($thaiki, 'ngay du sinh deleted successfully');
    }
}
