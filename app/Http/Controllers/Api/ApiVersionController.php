<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Version\createVersion;
use App\Services\Version\getNewVersion;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiVersionController extends Controller
{
    private $createVersion;
    private $getNewVersion;

    public function __construct(
        createVersion $createVersion,
        getNewVersion $getNewVersion,
    ){
        $this->middleware('auth:api');
        $this->createVersion = $createVersion;
        $this->getNewVersion = $getNewVersion;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'version_id' => 'required',
            'update_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $version = $this->createVersion->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $version;
    }

    public function getNewVersion()
    {
        try {
            $version = $this->getNewVersion->handle();
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $version;
    }
}
