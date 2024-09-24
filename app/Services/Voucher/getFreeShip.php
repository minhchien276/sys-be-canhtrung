<?php
namespace App\Services\Voucher;

use App\Models\voucher;

class getFreeShip
{
    public function handle()
    {
        $voucher = voucher::where('idTypeVoucher', 1)->get();

        return $voucher;
    }
}