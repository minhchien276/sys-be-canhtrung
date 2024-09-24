<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Voucher\createVoucher;
use App\Services\Voucher\deleteVoucher;
use App\Services\Voucher\getFreeShip;
use App\Services\Voucher\getVoucher;
use App\Services\Voucher\updateVoucher;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiVoucherController extends Controller
{
    private $createVoucher;
    private $updateVoucher;
    private $deleteVoucher;
    private $getFreeShip;
    private $getVoucher;
    

    public function __construct(
        createVoucher $createVoucher,
        updateVoucher $updateVoucher,
        deleteVoucher $deleteVoucher,
        getFreeShip $getFreeShip,
        getVoucher $getVoucher,
    ){
        $this->middleware('auth:api');
        $this->createVoucher = $createVoucher;
        $this->updateVoucher = $updateVoucher;
        $this->deleteVoucher = $deleteVoucher;
        $this->getFreeShip = $getFreeShip;
        $this->getVoucher = $getVoucher;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required',
            'minPrice' => 'required',
            'maxPrice' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $voucher = $this->createVoucher->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required',
            'minPrice' => 'required',
            'maxPrice' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $voucher = $this->updateVoucher->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher;
    }

    public function delete($id)
    {
        try {
            $voucher = $this->deleteVoucher->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher;
    }

    public function getFreeShip()
    {
        try {
            $voucher = $this->getFreeShip->handle();
        } catch (Exception $e) {
            return Responder::fail([], $e->getMessage());
        }

        return Responder::success($voucher, 'getFreeShip get success');
    }

    public function getVoucher($maNguoiDung)
    {
        try {
            $voucher = $this->getVoucher->handle($maNguoiDung);
        } catch (Exception $e) {
            return Responder::fail([], $e->getMessage());
        }

        return $voucher;
    }
}
