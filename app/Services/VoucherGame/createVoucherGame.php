<?php
namespace App\Services\VoucherGame;

use App\Models\voucher;
use App\Models\voucher_game;
use Carbon\Carbon;

class createVoucherGame
{
    public function handle($request)
    {
        $voucher = voucher::create([
            'discount' => $request->discount,
            'minPrice' => $request->minPrice,
            'maxPrice' => $request->maxPrice,
            'status' => $request->status,
            'idTypeVoucher' => 3,
            'created_at' => Carbon::now(),
        ]);

        $voucher_game = voucher_game::create([
            'maNguoiDung' => $request->maNguoiDung,
            'voucher_id' => $voucher->id,
            'status' => 0,
            'expired' => Carbon::now()->addDay(),
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'data' => $voucher_game,
            'message' => "success",
            'status' => true,
        ], 200);
    }
}