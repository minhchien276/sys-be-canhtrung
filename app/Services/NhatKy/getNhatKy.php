<?php

namespace App\Services\NhatKy;

use App\Models\nhatky;

class getNhatKy
{
    public function handle($maNguoiDung, $thoiGian)
    {
        $nhatky = nhatky::where('maNguoiDung', $maNguoiDung)
                        ->where('tonTai', 0)
                        ->where('thoiGian', $thoiGian)
                        ->first();

        return $nhatky;
    }
}
