<?php

namespace App\Http\Controllers\Api;

use App\Services\CauTraLoi\createCauTraLoi;
use App\Services\CauTraLoi\findCauTraLoi;
use App\Services\CauTraLoi\updateCauTraLoi;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CauTraLoiController extends Controller
{
    private $createCauTraLoi;
    private $updateCauTraLoi;
    private $findCauTraLoi;

    public function __construct(
        createCauTraLoi $createCauTraLoi,
        updateCauTraLoi $updateCauTraLoi,
        findCauTraLoi $findCauTraLoi,
    ) {
        $this->middleware('auth:api');
        $this->createCauTraLoi = $createCauTraLoi;
        $this->updateCauTraLoi = $updateCauTraLoi;
        $this->findCauTraLoi = $findCauTraLoi;
    }

    public function insert(Request $request)
    {
        foreach ($request->all() as $item) {
            $validator = Validator::make($item, [
                'maNhatKy' => 'required|numeric',
                'maCauHoi' => 'required|numeric',
                'cauTraLoi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'status' => false
                ], 400);
            }
        }

        try {
            $ctl = $this->createCauTraLoi->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($ctl, 'CauTraLoi created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cauTraLoi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $ctl = $this->updateCauTraLoi->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail($ctl, $e->getMessage());
        }

        return Responder::success($ctl, 'CauTraLoi updated successfully');
    }

    public function find($maNhatKy)
    {
        try {
            $ctl = $this->findCauTraLoi->handle($maNhatKy);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }
        return Responder::success($ctl, 'find successfully');
    }
}
