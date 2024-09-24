<?php
namespace App\Services\ThaiKi;

use App\Models\thaiki;

class updateThaiKi
{
    public function handle($request, $id)
    {
        $thaiki = thaiki::where('maNguoiDung', $id)->update([
            'ngayQuanHe' => $request->ngayQuanHe,
            'ngayDuSinh' => $request->ngayDuSinh,
            'ngayTestThuThai' => $request->ngayTestThuThai,
            'ketQuaVangDa' => $request->ketQuaVangDa,
        ]);

        return $thaiki;
    }
}