<?php

namespace App\Services\KetQuaTest;

use App\Models\ketquatest;

class findKetQuaTest
{
    public function handle($id)
    {
        $ketquatest = ketquatest::join('quanlyquetest', 'ketquatest.maQuanLyQueTest', '=', 'quanlyquetest.maQuanLyQueTest')
            ->select('ketquatest.*')
            ->where('quanlyquetest.maNguoiDung', $id)
            ->where('ketquatest.maLoaiQue', 1)
            ->orderByDesc('thoiGian')   
            ->get();

        return $ketquatest;
    }
}
