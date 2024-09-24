<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnDam\createAnDam;
use App\Services\AnDam\deleteAnDam;
use App\Services\AnDam\findAnDam;
use App\Services\AnDam\updateAnDam;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAnDamController extends Controller
{
    private $createAnDam;
    private $updateAnDam;
    private $findAnDam;
    private $deleteAnDam;

    public function __construct(
        createAnDam $createAnDam,
        updateAnDam $updateAnDam,
        findAnDam $findAnDam,
        deleteAnDam $deleteAnDam
    ){
        $this->middleware('auth:api');
        $this->createAnDam = $createAnDam;
        $this->updateAnDam = $updateAnDam;
        $this->findAnDam = $findAnDam;
        $this->deleteAnDam = $deleteAnDam;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loaiThucPham' => 'required',
            'trongLuong' => 'required',
            'id_con' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $andam = $this->createAnDam->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($andam, 'AnDam created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'loaiThucPham' => 'required',
            'trongLuong' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $andam = $this->updateAnDam->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($andam, 'AnDam updated successfully');
    }

    public function find($id)
    {
        try {
            $andam = $this->findAnDam->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($andam, 'find successfully');
    }

    public function delete($id)
    {
        try {
            $andam = $this->deleteAnDam->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($andam, 'delete successfully');
    }
}
