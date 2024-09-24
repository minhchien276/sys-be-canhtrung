<?php
namespace App\Services\VoucherUser;

use App\Models\voucher_user;
use Carbon\Carbon;

class createVoucherUser
{
    public function handle($request)
    {
        $voucher_user = voucher_user::create([
            'maNguoiDung' => $request->maNguoiDung,
            'voucher_id' => $request->voucher_id,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'data' => $voucher_user,
            'message' => "success",
            'status' => true,
        ], 200);
    }
}