<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BuMe\createBuMe;
use App\Services\BuMe\deleteBuMe;
use App\Services\BuMe\findBuMe;
use App\Services\BuMe\updateBuMe;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBuMeController extends Controller
{
    private $createBuMe;
    private $updateBuMe;
    private $findBuMe;
    private $deleteBuMe;

    public function __construct(
        createBuMe $createBuMe,
        updateBuMe $updateBuMe,
        findBuMe $findBuMe,
        deleteBuMe $deleteBuMe
    ) {
        $this->middleware('auth:api');
        $this->createBuMe = $createBuMe;
        $this->updateBuMe = $updateBuMe;
        $this->findBuMe = $findBuMe;
        $this->deleteBuMe = $deleteBuMe;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trai' => 'required|numeric',
            'phai' => 'required|numeric',
            'id_con' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $bume = $this->createBuMe->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bume, 'bume created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'trai' => 'required|numeric',
            'phai' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $bume = $this->updateBuMe->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bume, 'bume updated successfully');
    }

    public function find($id)
    {
        try {
            $bume = $this->findBuMe->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bume, 'find successfully');
    }

    public function delete($id)
    {
        try {
            $bume = $this->deleteBuMe->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($bume, 'delete successfully');
    }
}
