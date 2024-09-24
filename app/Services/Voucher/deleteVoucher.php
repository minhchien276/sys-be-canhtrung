<?php
namespace App\Services\Voucher;

use App\Models\voucher;

class deleteVoucher
{
    public function handle($id)
    {
        $voucher = voucher::where('id', $id)->delete();

        return $voucher;
    }
}