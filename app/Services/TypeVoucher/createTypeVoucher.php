<?php
namespace App\Services\TypeVoucher;

use App\Models\type_voucher;
use Carbon\Carbon;

class createTypeVoucher
{
    public function handle($request)
    {
        $type_voucher = type_voucher::create([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        return response()->json([
            'data' => $type_voucher,
            'message' => "success",
            'status' => true,
        ], 200);
    }
}