<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BuBinh\createBuBinh;
use App\Services\BuBinh\findBuBinh;
use App\Services\BuBinh\updateBuBinh;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBuBinhController extends Controller
{
    private $createBuBinh;
    private $updateBuBinh;
    private $findBuBinh;

    public function __construct(
        createBuBinh $createBuBinh,
        updateBuBinh $updateBuBinh,
        findBuBinh $findBuBinh,
    ){
        $this->middleware('auth:api');
        $this->createBuBinh = $createBuBinh;
        $this->updateBuBinh = $updateBuBinh;
        $this->findBuBinh = $findBuBinh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'suaCongThuc' => 'required|numeric',
            'suaMe' => 'required|numeric',
            'id_con' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $bubinh = $this->createBuBinh->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bubinh, 'AnDam created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'suaCongThuc' => 'required|numeric',
            'suaMe' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $bubinh = $this->updateBuBinh->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bubinh, 'AnDam updated successfully');
    }

    public function find($id)
    {
        try {
            $bubinh = $this->findBuBinh->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bubinh, 'find successfully');
    }
}
