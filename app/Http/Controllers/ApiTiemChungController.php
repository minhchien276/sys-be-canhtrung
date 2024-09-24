<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\TiemChung\createTiemChung;
use App\Services\TiemChung\deleteTiemChung;
use App\Services\TiemChung\getTiemChung;
use App\Services\TiemChung\updateTiemChung;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTiemChungController extends Controller
{
    private $createTiemChung;
    private $updateTiemChung;
    private $getTiemChung;
    private $deleteTiemChung;

    public function __construct(
        createTiemChung $createTiemChung,
        updateTiemChung $updateTiemChung,
        getTiemChung $getTiemChung,
        deleteTiemChung $deleteTiemChung,
    ) {
        $this->middleware('auth:api');
        $this->createTiemChung = $createTiemChung;
        $this->updateTiemChung = $updateTiemChung;
        $this->getTiemChung = $getTiemChung;
        $this->deleteTiemChung = $deleteTiemChung;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_vacxin' => 'required',
            'lanTiem' => 'required',
            'thoiGian' => 'required',
            'id_con' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $tiemchung = $this->createTiemChung->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($tiemchung, 'tiemchung created successfully');
    }

    public function update(Request $request, $id_con, $id_vacxin)
    {
        $validator = Validator::make($request->all(), [
            'lanTiem' => 'required',
            'thoiGian' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $tiemchung = $this->updateTiemChung->handle($request, $id_con, $id_vacxin);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($tiemchung, 'tiemchung updated successfully');
    }

    public function get($id_con, $id_vacxin)
    {
        try {
            $tiemchung = $this->getTiemChung->handle($id_con, $id_vacxin);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($tiemchung, 'tiemchung get successfully');
    }

    public function delete($id)
    {
        try {
            $tiemchung = $this->deleteTiemChung->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($tiemchung, 'tiemchung deleted successfully');
    }
}
