<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Benh\createBenh;
use App\Services\Benh\deleteBenh;
use App\Services\Benh\findBenh;
use App\Services\Benh\updateBenh;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBenhController extends Controller
{
    private $createBenh;
    private $updateBenh;
    private $deleteBenh;
    private $findBenh;

    public function __construct(
        createBenh $createBenh,
        updateBenh $updateBenh,
        deleteBenh $deleteBenh,
        findBenh $findBenh,
    ){
        $this->middleware('auth:api');
        $this->createBenh = $createBenh;
        $this->updateBenh = $updateBenh;
        $this->deleteBenh = $deleteBenh;
        $this->findBenh = $findBenh;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $benh = $this->createBenh->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($benh, 'Benh created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $benh = $this->updateBenh->handle($request, $id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($benh, 'Benh updated successfully');
    }

    public function delete($id)
    {
        try {
            $benh = $this->deleteBenh->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($benh, 'Benh deleted successfully');
    }

    public function find($id)
    {
        try {
            $benh = $this->findBenh->handle($id);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($benh, 'Benh find successfully');
    }
}
