<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LichKham\createLichKham;
use App\Services\LichKham\deleteLichKham;
use App\Services\LichKham\updateLichKham;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLichKhamController extends Controller
{
    private $createLichKham;
    private $updateLichKham;
    private $deleteLichKham;

    public function __construct(
        createLichKham $createLichKham,
        updateLichKham $updateLichKham,
        deleteLichKham $deleteLichKham,
    ) {
        $this->middleware('auth:api');
        $this->createLichKham = $createLichKham;
        $this->updateLichKham = $updateLichKham;
        $this->deleteLichKham = $deleteLichKham;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id_phongkham" => 'required',
            "maNguoiDung" => 'required',
            "id_tvv" => 'required',
            "phone" => 'required|numeric',
            "datetime" => 'required',
            "status" => 'required|numeric',
            "id_benh" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $lichkham = $this->createLichKham->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($lichkham, 'Lich kham created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "id_phongkham" => 'required',
            "maNguoiDung" => 'required',
            "id_tvv" => 'required',
            "phone" => 'required|numeric',
            "datetime" => 'required',
            "status" => 'required|numeric',
            "id_benh" => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $lichkham = $this->updateLichKham->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($lichkham, 'Lich kham updated successfully');
    }

    public function delete($id)
    {
        try {
            $lichkham = $this->deleteLichKham->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($lichkham, 'Lich kham deleted successfully');
    }
}
