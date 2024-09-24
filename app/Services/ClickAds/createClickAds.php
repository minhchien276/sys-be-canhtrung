<?php
namespace App\Services\ClickAds;

use App\Models\clickads;
use Carbon\Carbon;

class createClickAds
{
    public function handle($request)
    {
        $thoiGian = Carbon::now()->toDateString();

        $click = clickads::create([
            "maNguoiDung" => $request->maNguoiDung,
            "id_quangcao" => $request->id_quangcao,
            "thoiGian" => $thoiGian,
        ]);

        return $click;
    }
}