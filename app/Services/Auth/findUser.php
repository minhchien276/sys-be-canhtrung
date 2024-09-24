<?php
namespace App\Services\Auth;

use App\Models\nguoidung;

class findUser
{
    public function handle($id)
    {
        $user = nguoidung::where('maNguoiDung', $id)->first();

        return $user;
    }
}
