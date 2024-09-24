<?php

namespace App\Http\Controllers\Api;

use App\Services\TuVanVien\createTuVanVien;
use App\Services\TuVanVien\deleteTuVanVien;
use App\Services\TuVanVien\findTuVanVien;
use App\Services\TuVanVien\getTuVanVien;
use App\Services\TuVanVien\updateTuVanVien;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\TuVanVien\getTvvByIdUser;
use App\Services\TuVanVien\redirectToZalo;

class TuVanVienController extends Controller
{
    private $createTuVanVien;
    private $updateTuVanVien;
    private $getTuVanVien;
    private $findTuVanVien;
    private $deleteTuVanVien;
    private $getTvvByIdUser;
    private $redirectToZalo;

    public function __construct(
        createTuVanVien $createTuVanVien,
        updateTuVanVien $updateTuVanVien,
        getTuVanVien $getTuVanVien,
        findTuVanVien $findTuVanVien,
        deleteTuVanVien $deleteTuVanVien,
        getTvvByIdUser $getTvvByIdUser,
        redirectToZalo $redirectToZalo,
    ){
        $this->middleware('auth:api');
        $this->createTuVanVien = $createTuVanVien;
        $this->updateTuVanVien = $updateTuVanVien;
        $this->getTuVanVien = $getTuVanVien;
        $this->findTuVanVien = $findTuVanVien;
        $this->deleteTuVanVien = $deleteTuVanVien;
        $this->getTvvByIdUser = $getTvvByIdUser;
        $this->redirectToZalo = $redirectToZalo;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenTvv' => 'required',
            'linkZalo' => 'required',
            'soDienThoai' => [
                'required',
                'regex:/^(0[3|5|7|8|9]|\+?84)([0-9]{8}|[0-9]{9})\b$/',  
            ],
            'linkAnh' => 'required',
            'kinhnghiem' => 'required',
            'gioithieu' => 'required',
            'rating' => 'required|numeric',
            'linkFb' => 'required',
            'status' => 'required|numeric',
            'id_loaitvv' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $tvv = $this->createTuVanVien->handle($request);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'TuVanVien created successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tenTvv' => 'required',
            'linkZalo' => 'required',
            'soDienThoai' => [
                'required',
                'regex:/^(0[3|5|7|8|9]|\+?84)([0-9]{8}|[0-9]{9})\b$/',  
            ],
            'linkAnh' => 'required',
            'kinhnghiem' => 'required',
            'gioithieu' => 'required',
            'rating' => 'required|numeric',
            'linkFb' => 'required',
            'status' => 'required|numeric',
            'id_loaitvv' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $tvv = $this->updateTuVanVien->handle($request, $id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'TuVanVien updated successfully');
    }

    public function get($id_loaitvv)
    {
        try {
            $tvv = $this->getTuVanVien->handle($id_loaitvv);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'TuVanVien get successfully');
    }

    public function find($id)
    {
        try {
            $tvv = $this->findTuVanVien->handle($id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'TuVanVien find successfully');
    }

    public function delete($id)
    {
        try {
            $tvv = $this->deleteTuVanVien->handle($id);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'TuVanVien deleted successfully');
    }

    public function getTvvByIdUser($id, $id_loaitvv)
    {
        try {
            $tvv = $this->getTvvByIdUser->handle($id, $id_loaitvv);
        }catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($tvv, 'find TuVanVien successfully');
    }

    public function redirectToZalo(Request $request, $maTvv)
    {
        return $this->redirectToZalo->redirectToZalo($request, $maTvv);
    }
}
