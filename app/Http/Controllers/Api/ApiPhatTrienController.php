<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PhatTrien\createPhatTrien;
use App\Services\PhatTrien\getPhatTrien;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPhatTrienController extends Controller
{
    private $createPhatTrien;
    private $getPhatTrien;

    public function __construct(
        createPhatTrien $createPhatTrien,
        getPhatTrien $getPhatTrien,
    ){
        $this->middleware('auth:api');
        $this->createPhatTrien = $createPhatTrien;
        $this->getPhatTrien = $getPhatTrien;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maCon' => 'required',
            'thoiGian' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $phattrien = $this->createPhatTrien->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($phattrien, 'PhatTrien created successfully');
    }

    public function get($maCon)
    {
        try {
            $phattrien = $this->getPhatTrien->handle($maCon);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($phattrien, 'PhatTrien get successfully');
    }

}
