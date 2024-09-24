<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class findKinhNguyet
{
    public function handle($id)
    {
        $kinhNguyet = kinhnguyet::where('maNguoiDung', $id)->get();

        return $kinhNguyet;
    }
}