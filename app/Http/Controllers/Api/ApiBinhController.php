<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Binh\createBinh;
use App\Services\Binh\deleteBinh;
use App\Services\Binh\findBinh;
use App\Services\Binh\updateBinh;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBinhController extends Controller
{
    private $createBinh;
    private $updateBinh;
    private $findBinh;
    private $deleteBinh;

    public function __construct(
        createBinh $createBinh,
        updateBinh $updateBinh,
        findBinh $findBinh,
        deleteBinh $deleteBinh
    ){
        $this->middleware('auth:api');
        $this->createBinh = $createBinh;
        $this->updateBinh = $updateBinh;
        $this->findBinh = $findBinh;
        $this->deleteBinh = $deleteBinh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lop' => 'required|numeric',
            'khoangCach' => 'required|numeric',
            'MaBinh' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $binh = $this->createBinh->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($binh, 'binh created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'lop' => 'required|numeric',
            'khoangCach' => 'required|numeric',
            'MaBinh' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $binh = $this->updateBinh->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($binh, 'binh updated successfully');
    }

    public function find($id)
    {
        try {
            $binh = $this->findBinh->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($binh, 'find successfully');
    }

    public function delete($id)
    {
        try {
            $binh = $this->deleteBinh->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($binh, 'delete successfully');
    }
}
