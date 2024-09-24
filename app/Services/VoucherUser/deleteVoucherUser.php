<?php
namespace App\Services\VoucherUser;

use App\Models\voucher_user;

class deleteVoucherUser
{
    public function handle($id)
    {
        $voucher_user = voucher_user::where('id', $id)->delete();

        return $voucher_user;
    }
}