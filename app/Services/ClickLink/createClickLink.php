<?php
namespace App\Services\ClickLink;

use App\Models\clicklink;

class createClickLink
{
    public function handle($request)
    {
        $click = clicklink::create([
            "maNguoiDung" => $request->maNguoiDung,
            "id_link" => $request->id_link,
            "thoiGian" => $request->thoiGian,
        ]);

        return $click;
    }
}