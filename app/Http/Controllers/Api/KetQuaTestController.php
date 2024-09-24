<?php

namespace App\Http\Controllers\Api;

use App\Services\KetQuaTest\createKetQuaTest;
use App\Services\KetQuaTest\findKetQuaTest;
use App\Services\KetQuaTest\updateKetQuaTest;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\KetQuaTest\getDatDinh;

class KetQuaTestController extends Controller
{
    private $createKetQuaTest;
    private $updateKetQuaTest;
    private $findKetQuaTest;
    private $getDatDinh;

    public function __construct(
        createKetQuaTest $createKetQuaTest,
        updateKetQuaTest $updateKetQuaTest,
        findKetQuaTest $findKetQuaTest,
        getDatDinh $getDatDinh,
    ) {
        $this->middleware('auth:api');
        $this->createKetQuaTest = $createKetQuaTest;
        $this->updateKetQuaTest = $updateKetQuaTest;
        $this->findKetQuaTest = $findKetQuaTest;
        $this->getDatDinh = $getDatDinh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maQuanLyQueTest' => 'required',
            'maLoaiQue' => 'required|numeric',
            'thoiGian' => 'required|numeric',
            'ketQua' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $ketquatest = $this->createKetQuaTest->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $ketquatest;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ketQua' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $ketquatest = $this->updateKetQuaTest->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($ketquatest, 'ketquatest updated successfully');
    }

    public function find($id)
    {
        try {
            $ketquatest = $this->findKetQuaTest->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($ketquatest, 'ketquatest found successfully');
    }

    public function getDatDinh($maQuanLyQueTest, $from, $to)
    {
        try {
            $ketquatest = $this->getDatDinh->handle($maQuanLyQueTest, $from, $to);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($ketquatest, 'ketquatest get successfully');
    }
}
