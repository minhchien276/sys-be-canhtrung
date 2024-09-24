<?php

namespace App\Services\KetQuaTest;

use App\Models\ketquatest;

class getDatDinh
{
    public function handle($maQuanLyQueTest, $from, $to)
    {
        $ketquatest = KetQuaTest::where('maQuanLyQueTest', $maQuanLyQueTest)
            ->whereBetween('thoiGian', [$from, $to])
            ->where('ketQua', '>=', 46)
            ->exists();

        return $ketquatest;
    }
}
