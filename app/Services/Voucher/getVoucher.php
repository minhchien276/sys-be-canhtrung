<?php

namespace App\Services\Voucher;

use App\Models\type_voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class getVoucher
{
    public function handle($maNguoiDung)
    {
        $type = type_voucher::get();

        foreach ($type as $item) {
            if ($item->id == 1) {
                $voucher_user = DB::table('vouchers')
                    ->where('vouchers.status', 0)
                    ->where('vouchers.expired', '>=', Carbon::now()->format('Y-m-d'))
                    ->where('vouchers.idTypeVoucher', $item->id)
                    ->get();

                if ($voucher_user->count() > 0) {
                    $result[] = [
                        "id" => $item->id,
                        "name" => $item->name,
                        "data" => $voucher_user,
                    ];
                }
            } else if ($item->id == 2) {
                $check = DB::table('voucher_user')
                    ->where('voucher_user.maNguoiDung', '=', $maNguoiDung)
                    ->pluck('voucher_id');

                $voucher_user = DB::table('vouchers')
                    ->where('vouchers.status', 0)
                    ->where('vouchers.expired', '>=', Carbon::now()->format('Y-m-d'))
                    ->where('vouchers.idTypeVoucher', $item->id)
                    ->whereNotIn('vouchers.id', $check)
                    ->get();

                if ($voucher_user->count() > 0) {
                    $result[] = [
                        "id" => $item->id,
                        "name" => $item->name,
                        "data" => $voucher_user,
                    ];
                }
            } else if ($item->id == 3) {
                $voucher_game = DB::table('voucher_game')
                    ->leftJoin('vouchers', 'voucher_game.voucher_id', '=', 'vouchers.id')
                    ->where('voucher_game.status', 0)
                    ->where('vouchers.status', 0)
                    ->where('voucher_game.maNguoiDung', '=', $maNguoiDung)
                    ->where('voucher_game.expired', '>=', Carbon::now()->format('Y-m-d'))
                    ->where('vouchers.idTypeVoucher', $item->id)
                    ->select('voucher_game.id as id', 'vouchers.id as id_voucher', 'vouchers.discount', 'vouchers.status', 'vouchers.minPrice', 'vouchers.maxPrice', 'vouchers.idTypeVoucher', 'voucher_game.expired', 'vouchers.quantity', 'vouchers.reQuantity', 'voucher_game.maNguoiDung')
                    ->get();


                if ($voucher_game->count() > 0) {
                    $result[] = [
                        "id" => $item->id,
                        "name" => $item->name,
                        "data" => $voucher_game,
                    ];
                }
            }
        }

        $response = [
            "data" => $result,
            "message" => "get successfully",
            "status" => true
        ];

        return response()->json($response);
    }
}
