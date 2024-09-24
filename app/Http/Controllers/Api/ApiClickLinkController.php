<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClickLink\createClickLink;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiClickLinkController extends Controller
{
    private $createClickLink;

    public function __construct(
        createClickLink $createClickLink
    ){
        $this->middleware('auth:api');
        $this->createClickLink = $createClickLink;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'id_link' => 'required',
            'thoiGian' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $click = $this->createClickLink->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($click, 'create click link successfully');
    }
}
