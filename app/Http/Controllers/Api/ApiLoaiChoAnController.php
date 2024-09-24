<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LoaiChoAn\createLoaiChoAn;
use App\Services\LoaiChoAn\deleteLoaiChoAn;
use App\Services\LoaiChoAn\findLoaiChoAn;
use App\Services\LoaiChoAn\updateLoaiChoAn;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLoaiChoAnController extends Controller
{
    private $createLoaiChoAn;
    private $updateLoaiChoAn;
    private $deleteLoaiChoAn;
    private $findLoaiChoAn;

    public function __construct(
        createLoaiChoAn $createLoaiChoAn,
        updateLoaiChoAn $updateLoaiChoAn,
        deleteLoaiChoAn $deleteLoaiChoAn,
        findLoaiChoAn $findLoaiChoAn,
    ){
        $this->middleware('auth:api');
        $this->createLoaiChoAn = $createLoaiChoAn;
        $this->updateLoaiChoAn = $updateLoaiChoAn;
        $this->deleteLoaiChoAn = $deleteLoaiChoAn;
        $this->findLoaiChoAn = $findLoaiChoAn;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenLoaiChoAn' => 'required',
            'donVi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $loaichoan = $this->createLoaiChoAn->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaichoan, 'loai cho an created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenLoaiChoAn' => 'required',
            'donVi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $loaichoan = $this->updateLoaiChoAn->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaichoan, 'loai cho an updated successfully');
    }

    public function delete($id)
    {
        try {
            $loaichoan = $this->deleteLoaiChoAn->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaichoan, 'loai cho an deleted successfully');
    }

    public function find($id)
    {
        try {
            $loaichoan = $this->findLoaiChoAn->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($loaichoan, 'loai cho an find successfully');
    }
}
