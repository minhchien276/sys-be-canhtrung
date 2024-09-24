<?php

namespace App\Http\Controllers\Api;

use App\Services\NhatKy\createNhatKy;
use App\Services\NhatKy\deleteNhatKy;
use App\Services\NhatKy\findNhatKy;
use App\Services\NhatKy\getNhatKy;
use App\Services\NhatKy\updateNhatKy;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\NhatKy\dongBoNhatKy;

class NhatKyController extends Controller
{
    private $createNhatKy;
    private $deleteNhatKy;
    private $findNhatKy;
    private $getNhatKy;
    private $dongBoNhatKy;

    public function __construct(
        createNhatKy $createNhatKy,
        deleteNhatKy $deleteNhatKy,
        findNhatKy $findNhatKy,
        getNhatKy $getNhatKy,
        dongBoNhatKy $dongBoNhatKy,
    ) {
        $this->middleware('auth:api');
        $this->createNhatKy = $createNhatKy;
        $this->deleteNhatKy = $deleteNhatKy;
        $this->findNhatKy = $findNhatKy;
        $this->getNhatKy = $getNhatKy;
        $this->dongBoNhatKy = $dongBoNhatKy;
    }

    //insert nhat ky
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'thoiGian' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $nhatky = $this->createNhatKy->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($nhatky, 'NhatKy created successfully');
    }

    //get nhatky
    public function find($id)
    {
        try {
            $nhatky = $this->findNhatKy->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($nhatky, 'NhatKy found successfully');
    }

    //delete nhatky
    public function delete($id)
    {
        try {
            $nhatky = $this->deleteNhatKy->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($nhatky, 'Nhatky deleted successfully');
    }

    public function getNhatKy($maNguoiDung, $thoiGian)
    {
        try {
            $nhatky = $this->getNhatKy->handle($maNguoiDung, $thoiGian);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($nhatky, 'Nhatky get successfully');
    }

    public function dongBoNhatKy(Request $request, $maNguoiDung)
    {
        return $this->dongBoNhatKy->handle($request, $maNguoiDung);
    }
}
