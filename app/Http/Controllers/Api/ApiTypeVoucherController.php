<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TypeVoucher\createTypeVoucher;
use App\Services\TypeVoucher\deleteTypeVoucher;
use App\Services\TypeVoucher\updateTypeVoucher;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTypeVoucherController extends Controller
{
    private $createTypeVoucher;
    private $updateTypeVoucher;
    private $deleteTypeVoucher;

    public function __construct(
        createTypeVoucher $createTypeVoucher,
        updateTypeVoucher $updateTypeVoucher,
        deleteTypeVoucher $deleteTypeVoucher,
    ){
        $this->middleware('auth:api');
        $this->createTypeVoucher = $createTypeVoucher;
        $this->updateTypeVoucher = $updateTypeVoucher;
        $this->deleteTypeVoucher = $deleteTypeVoucher;
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
            $type_voucher = $this->createTypeVoucher->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $type_voucher;
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
            $type_voucher = $this->updateTypeVoucher->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $type_voucher;
    }

    public function delete($id)
    {
        try {
            $type_voucher = $this->deleteTypeVoucher->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $type_voucher;
    }
}
