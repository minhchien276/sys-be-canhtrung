<?php
namespace App\Services\TypeVoucher;

use App\Models\type_voucher;

class deleteTypeVoucher
{
    public function handle($id)
    {
        $type_voucher = type_voucher::where('id', $id)->delete();

        return $type_voucher;
    }
}