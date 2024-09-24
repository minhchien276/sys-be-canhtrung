<?php
namespace App\Services\ThaiKi;

use App\Models\thaiki;

class findThaiKi
{
    public function handle($id)
    {
        $thaiki = thaiki::where('maNguoiDung', $id)->first();

        return $thaiki;
    }
}
