<?php
namespace App\Services\Voucher;

use App\Models\voucher;
use Carbon\Carbon;

class createVoucher
{
    public function handle($request)
    {
        $voucher = voucher::create([
            'discount' => $request->discount,
            'minPrice' => $request->minPrice,
            'maxPrice' => $request->maxPrice,
            'status' => $request->status,
            'idTypeVoucher' => $request->idTypeVoucher,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'data' => $voucher,
            'message' => "success",
            'status' => true,
        ], 200);
    }
}