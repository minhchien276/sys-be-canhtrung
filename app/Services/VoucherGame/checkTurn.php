<?php

namespace App\Services\VoucherGame;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class checkTurn
{
    public function handle($maNguoiDung)
    {
        $tomorrow = Carbon::tomorrow();

        $voucher_game = DB::table('voucher_game')
            ->where('maNguoiDung', $maNguoiDung)
            ->where('expired', $tomorrow)
            ->count();

        $turn = 3 - $voucher_game;

        return response()->json([
            'data' => $turn,
            'message' => "success",
            'status' => true,
        ], 200);
    }
}
