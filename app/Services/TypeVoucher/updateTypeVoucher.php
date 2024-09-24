<?php
namespace App\Services\TypeVoucher;

use App\Models\type_voucher;
use Carbon\Carbon;

class updateTypeVoucher
{
    public function handle($request, $id)
    {
        $type_voucher = type_voucher::where('id', $id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);

        return $type_voucher;
    }
}