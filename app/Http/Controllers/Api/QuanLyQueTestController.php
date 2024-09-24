<?php

namespace App\Http\Controllers\Api;

use App\Services\QuanLyQueTest\createQuanLyQueTest;
use App\Services\QuanLyQueTest\findQuanLyQueTest;
use App\Services\QuanLyQueTest\getQuanLyQueTest;
use App\Services\QuanLyQueTest\updateQuanLyQueTest;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class QuanLyQueTestController extends Controller
{
    private $createQuanLyQueTest;
    private $updateQuanLyQueTest;
    private $findQuanLyQueTest;
    private $getQuanLyQueTest;

    public function __construct(
        createQuanLyQueTest $createQuanLyQueTest,
        updateQuanLyQueTest $updateQuanLyQueTest,
        findQuanLyQueTest $findQuanLyQueTest,
        getQuanLyQueTest $getQuanLyQueTest,
    ) {
        $this->middleware('auth:api');
        $this->createQuanLyQueTest = $createQuanLyQueTest;
        $this->updateQuanLyQueTest = $updateQuanLyQueTest;
        $this->findQuanLyQueTest = $findQuanLyQueTest;
        $this->getQuanLyQueTest = $getQuanLyQueTest;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $qlqt = $this->createQuanLyQueTest->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($qlqt, 'QuanLyQueTest created successfully');
    }

    public function update($id)
    {
        try {
            $qlqt = $this->updateQuanLyQueTest->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($qlqt, 'QuanLyQueTest updated successfully');
    }

    public function find($id)
    {
        try {
            $qlqt = $this->findQuanLyQueTest->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $qlqt;
    }

    public function get($id)
    {
        try {
            $qlqt = $this->getQuanLyQueTest->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $qlqt;
    }
}
