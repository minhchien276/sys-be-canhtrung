<?php
namespace App\Services\ThaiKi;

use App\Models\thaiki;

class deleteNgayDuSinh
{
    public function handle($id)
    {
        $thaiki = thaiki::where('maNguoiDung', $id)->update([
            'ngayDuSinh' => null,
        ]);

        return $thaiki;
    }
}