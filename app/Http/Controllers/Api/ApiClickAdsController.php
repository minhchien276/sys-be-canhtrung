<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClickAds\createClickAds;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiClickAdsController extends Controller
{
    private $createClickAds;

    public function __construct(
        createClickAds $createClickAds
    ){
        $this->middleware('auth:api');
        $this->createClickAds = $createClickAds;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'id_quangcao' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $click = $this->createClickAds->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, 'error creating click ads');
        }

        return Responder::success($click, 'create click ads successfully');
    }
}
