<?php
namespace App\Services\VoucherUser;

use App\Models\voucher_user;
use Carbon\Carbon;

class updateVoucherUser
{
    public function handle($request, $id)
    {
        $voucher_user = voucher_user::where('id', $id)->update([
            'maNguoiDung' => $request->maNguoiDung,
            'voucher_id' => $request->voucher_id,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);

        return $voucher_user;
    }
}