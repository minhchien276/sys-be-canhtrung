<?php
namespace App\Services\Voucher;

use App\Models\voucher;
use Carbon\Carbon;

class updateVoucher
{
    public function handle($request, $id)
    {
        $voucher = voucher::where('id', $id)->update([
            'discount' => $request->discount,
            'minPrice' => $request->minPrice,
            'maxPrice' => $request->maxPrice,
            'status' => $request->status,
            'idTypeVoucher' => $request->idTypeVoucher,
            'updated_at' => Carbon::now(),
        ]);

        return $voucher;
    }
}