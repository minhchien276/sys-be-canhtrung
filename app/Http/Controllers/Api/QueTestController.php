<?php

namespace App\Http\Controllers\Api;

use App\Services\QueTest\createQueTest;
use App\Services\QueTest\updateQueTest;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class QueTestController extends Controller
{
    private $createQueTest;
    private $updateQueTest;

    public function __construct(
        createQueTest $createQueTest,
        updateQueTest $updateQueTest,
    ){
        $this->middleware('auth:api');
        $this->createQueTest = $createQueTest;
        $this->updateQueTest = $updateQueTest;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maLoaiQue' => 'required',
            'tenQue' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $quetest = $this->createQueTest->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quetest, 'QueTest created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenQue' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $quetest = $this->updateQueTest->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quetest, 'QueTest updated successfully');
    }
}
