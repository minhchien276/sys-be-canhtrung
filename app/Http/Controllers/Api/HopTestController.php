<?php

namespace App\Http\Controllers\Api;

use App\Services\HopTest\createHopTest;
use App\Services\HopTest\deleteHopTest;
use App\Services\HopTest\updateHopTest;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class HopTestController extends Controller
{
    private $createHopTest;
    private $updateHopTest;
    private $deleteHopTest;

    public function __construct(
        createHopTest $createHopTest,
        updateHopTest $updateHopTest,
        deleteHopTest $deleteHopTest,
    ) {
        $this->middleware('auth:api');
        $this->createHopTest = $createHopTest;
        $this->updateHopTest = $updateHopTest;
        $this->deleteHopTest = $deleteHopTest;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maHopTest' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $hoptest = $this->createHopTest->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hoptest, 'Hoptest created successfully');
    }

    public function update(Request $request, $id)
    {
        return $this->updateHopTest->handle($request, $id);
    }

    public function delete($id)
    {
        try {
            $hoptest = $this->deleteHopTest->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($hoptest, 'Hoptest deleted successfully');
    }
}
