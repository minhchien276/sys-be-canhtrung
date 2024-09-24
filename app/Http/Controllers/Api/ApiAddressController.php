<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Address\createAddress;
use App\Services\Address\deleteAddress;
use App\Services\Address\getAllAddress;
use App\Services\Address\updateAddress;
use App\Services\Address\updateStatusAddress;
use App\Supports\Responder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAddressController extends Controller
{
    private $createAddress;
    private $updateAddress;
    private $deleteAddress;
    private $getAllAddress;
    private $updateStatusAddress;

    public function __construct(
        createAddress $createAddress,
        updateAddress $updateAddress,
        deleteAddress $deleteAddress,
        getAllAddress $getAllAddress,
        updateStatusAddress $updateStatusAddress,
    ) {
        $this->middleware('auth:api');
        $this->createAddress = $createAddress;
        $this->updateAddress = $updateAddress;
        $this->deleteAddress = $deleteAddress;
        $this->getAllAddress = $getAllAddress;
        $this->updateStatusAddress = $updateStatusAddress;
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provinces' => 'required',
            'districts' => 'required',
            'wards' => 'required',
            'address_specific' => 'required',
            'maNguoiDung' => 'required',
            'username' => 'required',
            'phone' => [
                'required',
                'regex:/^(0[3|5|7|8|9]\d{8}|(?:\+?84|\b84)\d{9})$/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $address = $this->createAddress->handle($request);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($address, 'address created successfully');
    }

    public function update(Request $request, $id, $maNguoiDung)
    {
        $validator = Validator::make($request->all(), [
            'provinces' => 'required',
            'districts' => 'required',
            'wards' => 'required',
            'address_specific' => 'required',
            'username' => 'required',
            'phone' => [
                'required',
                'regex:/^(0[3|5|7|8|9]\d{8}|(?:\+?84|\b84)\d{9})$/',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $address = $this->updateAddress->handle($request, $id, $maNguoiDung);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($address, 'address updated successfully');
    }

    public function delete($id, $maNguoiDung)
    {
        try {
            $address = $this->deleteAddress->handle($id, $maNguoiDung);    
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        }

        return Responder::success($address, 'address updated successfully');
    }

    public function getAllAddress($maNguoiDung)
    {
        try {
            $address = $this->getAllAddress->handle($maNguoiDung);    
        } catch (Exception $e) {
            return Responder::fail([], $e->getMessage());
        }

        return Responder::success($address, 'address get all successfully');
    }

    public function updateStatusAddress($id, $maNguoiDung)
    {
        try {
            $address = $this->updateStatusAddress->handle($id, $maNguoiDung);    
        } catch (Exception $e) {
            return Responder::fail([], $e->getMessage());
        }

        return Responder::success($address, 'address update successfully');
    }
}
