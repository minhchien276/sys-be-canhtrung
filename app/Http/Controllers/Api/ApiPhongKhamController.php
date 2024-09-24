<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PhongKham\createPhongKham;
use App\Services\PhongKham\deletePhongKham;
use App\Services\PhongKham\updatePhongKham;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPhongKhamController extends Controller
{
    private $createPhongKham;
    private $updatePhongKham;
    private $deletePhongKham;

    public function __construct(
        createPhongKham $createPhongKham,
        updatePhongKham $updatePhongKham,
        deletePhongKham $deletePhongKham,
    ) {
        $this->middleware('auth:api');
        $this->createPhongKham = $createPhongKham;
        $this->updatePhongKham = $updatePhongKham;
        $this->deletePhongKham = $deletePhongKham;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $phongkham = $this->createPhongKham->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($phongkham, 'PhongKham created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $phongkham = $this->updatePhongKham->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($phongkham, 'PhongKham updated successfully');
    }

    public function delete($id)
    {
        try {
            $phongkham = $this->deletePhongKham->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($phongkham, 'PhongKham deleted successfully');
    }
}
