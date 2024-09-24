<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CauHoi\createCauHoi;
use App\Services\CauHoi\deleteCauHoi;
use App\Services\CauHoi\updateCauHoi;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CauHoiController extends Controller
{
    private $createCauHoi;
    private $updateCauHoi;
    private $deleteCauHoi;

    public function __construct(
        createCauHoi $createCauHoi,
        updateCauHoi $updateCauHoi,
        deleteCauHoi $deleteCauHoi,
    ){
        $this->middleware('auth:api');
        $this->createCauHoi = $createCauHoi;
        $this->updateCauHoi = $updateCauHoi;
        $this->deleteCauHoi = $deleteCauHoi;
    }    

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maCauHoi' => 'required',
            'noiDung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $cauhoi = $this->createCauHoi->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($cauhoi, 'Cauhoi created successfully');
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'noiDung' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $cauhoi = $this->updateCauHoi->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($cauhoi, 'Cauhoi updated successfully');
    }

    public function delete($id)
    {
        try {
            $cauhoi = $this->deleteCauHoi->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($cauhoi, 'Cauhoi deleted successfully');
    }
}
