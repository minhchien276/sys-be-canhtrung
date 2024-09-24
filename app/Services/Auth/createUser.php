<?php

namespace App\Services\Auth;

use App\Models\nguoidung;
use Illuminate\Support\Str;

class createUser
{
    public function handle($request)
    {
        $taiKhoan = $request->taiKhoan;
        if (strpos($taiKhoan, '84') === 0) {
            $taiKhoan = '0' . substr($taiKhoan, 2);
        }
        if (strpos($taiKhoan, '+84') === 0) {
            $taiKhoan = '0' . substr($taiKhoan, 3);
        }

        $user = nguoidung::create([
            'maNguoiDung' => Str::random(40),
            'email' => $request->email,
            'taiKhoan' => $taiKhoan,
            'tenNguoiDung' => $request->tenNguoiDung,
            'namSinh' => $request->namSinh,
            'matKhau' => bcrypt($request->matKhau),
            'maPhanQuyen' => 4,
            'ngayTao' => $request->ngayTao,
        ]);

        return $user;
    }
}
