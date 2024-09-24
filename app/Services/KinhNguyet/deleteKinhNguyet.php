<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class deleteKinhNguyet
{
    public function handle($id)
    {
        $kinhNguyet = kinhnguyet::where('maNguoiDung', $id)->delete();

        return $kinhNguyet;
    }
}
