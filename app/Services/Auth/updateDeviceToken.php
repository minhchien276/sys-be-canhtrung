<?php

namespace App\Services\Auth;

use App\Models\nguoidung;
use App\Supports\Responder;
use Exception;
use Illuminate\Support\Facades\Validator;

class updateDeviceToken
{
    public function handle($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false
            ], 400);
        }

        try {
            $data = nguoidung::where('maNguoiDung', $id)->update([
                'device_token' => $request->device_token,
            ]);
        } catch (Exception $e) {
            return Responder::fail(null, $e->getMessage());
        };

        return Responder::success($data, 'Device token updated successfully');
    }
}
