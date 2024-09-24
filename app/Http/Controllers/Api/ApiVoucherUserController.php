<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\VoucherUser\createVoucherUser;
use App\Services\VoucherUser\deleteVoucherUser;
use App\Services\VoucherUser\updateVoucherUser;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiVoucherUserController extends Controller
{
    private $createVoucherUser;
    private $updateVoucherUser;
    private $deleteVoucherUser;
    

    public function __construct(
        createVoucherUser $createVoucherUser,
        updateVoucherUser $updateVoucherUser,
        deleteVoucherUser $deleteVoucherUser,
    ){
        $this->middleware('auth:api');
        $this->createVoucherUser = $createVoucherUser;
        $this->updateVoucherUser = $updateVoucherUser;
        $this->deleteVoucherUser = $deleteVoucherUser;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'voucher_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $voucher_user = $this->createVoucherUser->handle($request);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher_user;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'maNguoiDung' => 'required',
            'voucher_id' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false   
            ], 400);
        }

        try {
            $voucher_user = $this->updateVoucherUser->handle($request, $id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher_user;
    }

    public function delete($id)
    {
        try {
            $voucher_user = $this->deleteVoucherUser->handle($id);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return $voucher_user;
    }
}
