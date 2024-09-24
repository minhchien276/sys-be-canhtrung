<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\QuangCao\createQuangCao;
use App\Services\QuangCao\deleteQuangCao;
use App\Services\QuangCao\findQuangCao;
use App\Services\QuangCao\updateQuangCao;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiQuangCaoController extends Controller
{
    private $createQuangCao;
    private $updateQuangCao;
    private $findQuangCao;
    private $deleteQuangCao;

    public function __construct(
        createQuangCao $createQuangCao,
        updateQuangCao $updateQuangCao,
        findQuangCao $findQuangCao,
        deleteQuangCao $deleteQuangCao,
    ){
        $this->middleware('auth:api');
        $this->createQuangCao = $createQuangCao;
        $this->updateQuangCao = $updateQuangCao;
        $this->findQuangCao = $findQuangCao;
        $this->deleteQuangCao = $deleteQuangCao;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'phase' => 'required',
            'type' => 'required',
            'status' => 'required',
            'link' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $quangcao = $this->createQuangCao->handle($request);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quangcao, 'Quang cao created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'phase' => 'required',
            'type' => 'required',
            'status' => 'required',
            'link' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $quangcao = $this->updateQuangCao->handle($request,  $id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quangcao, 'Quang cao updated successfully');
    }

    public function find($phase, $type)
    {
        try {
            $quangcao = $this->findQuangCao->handle($phase, $type);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quangcao, 'Quang cao find successfully');
    }

    public function delete($id)
    {
        try {
            $quangcao = $this->deleteQuangCao->handle($id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($quangcao, 'Quang cao deleted successfully');
    }
}
