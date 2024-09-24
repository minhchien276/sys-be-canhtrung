<?php

namespace App\Http\Controllers\Api;

use App\Services\KinhNguyet\createKinhNguyet;
use App\Services\KinhNguyet\deleteKinhNguyet;
use App\Services\KinhNguyet\findKinhNguyet;
use App\Services\KinhNguyet\updateKinhNguyet;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Services\KinhNguyet\deleteKinhNguyetByDate;
use App\Services\KinhNguyet\dongboKinhNguyet;

class KinhNguyetController extends Controller
{
    private $createKinhNguyet;
    private $findKinhNguyet;
    private $deleteKinhNguyet;
    private $updateKinhNguyet;
    private $dongboKinhNguyet;
    private $deleteKinhNguyetByDate;

    public function __construct(
        createKinhNguyet $createKinhNguyet,
        findKinhNguyet $findKinhNguyet,
        deleteKinhNguyet $deleteKinhNguyet,
        updateKinhNguyet $updateKinhNguyet,
        dongboKinhNguyet $dongboKinhNguyet,
        deleteKinhNguyetByDate $deleteKinhNguyetByDate,
    ) {
        $this->middleware('auth:api');
        $this->createKinhNguyet = $createKinhNguyet;
        $this->findKinhNguyet = $findKinhNguyet;
        $this->deleteKinhNguyet = $deleteKinhNguyet;
        $this->updateKinhNguyet = $updateKinhNguyet;
        $this->dongboKinhNguyet = $dongboKinhNguyet;
        $this->deleteKinhNguyetByDate = $deleteKinhNguyetByDate;
    }

    //insert kinh nguyet
    public function insert(Request $request)
    {
        foreach ($request->all() as $item) {
            $validator = Validator::make($item, [
                'maNguoiDung' => 'required',
                'tbnkn' => 'required|numeric',
                'snck' => 'required|numeric',
                'snct' => 'required|numeric',
                'ckdn' => 'required|numeric',
                'cknn' => 'required|numeric',
                'ngayBatDau' => 'required|numeric',
                'ngayKetThuc' => 'required|numeric',
                'ngayBatDauKinh' => 'required|numeric',
                'ngayKetThucKinh' => 'required|numeric',
                'ngayBatDauTrung' => 'required|numeric',
                'ngayKetThucTrung' => 'required|numeric',
                'trangThai' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'status' => false
                ], 400);
            }
        }

        try {
            $kinhnguyet = $this->createKinhNguyet->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($kinhnguyet, 'Kinh nguyet inserted successfully');
    }

    // find list kinh nguyệt
    public function find($id)
    {
        try {
            $kinhnguyet = $this->findKinhNguyet->handle($id);
            return Responder::success($kinhnguyet, 'Find kinhnguyet successfully');
        } catch (Exception $e) {
            return Responder::fail($kinhnguyet, $e->getMessage());
        };
    }

    public function delete($id)
    {
        try {
            $kinhNguyet = $this->deleteKinhNguyet->handle($id);
        } catch (Exception $e) {
            return Responder::fail($kinhNguyet, $e->getMessage());
        };

        return Responder::success($kinhNguyet, 'Deleted successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'trangThai' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $kinhNguyet = $this->updateKinhNguyet->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($kinhNguyet, 'Kinhnguyet update successfully');
    }

    public function dongboKinhNguyet(Request $request, $id)
    {
        try {
            $kinhNguyet = $this->dongboKinhNguyet->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($kinhNguyet, 'Kinhnguyet update successfully');
    }

    public function deleteByDate(Request $request, $maNguoiDung)
    {
        try {
            $kinhNguyet = $this->deleteKinhNguyetByDate->handle($maNguoiDung, $request);
        } catch (Exception $e) {
            return response()->json([
                'status' => false
            ], 500);
        };

        return $kinhNguyet;
    }
}
