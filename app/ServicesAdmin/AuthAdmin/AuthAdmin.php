<?php

namespace App\ServicesAdmin\AuthAdmin;

use App\Models\nguoidung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthAdmin
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function signIn($request)
    {
        $admin = nguoidung::where('email', $request->email)
            ->where('maPhanQuyen', '!=', 4)
            ->first();

        if ($admin && Hash::check($request->password, $admin->matKhau)) {
            Session::put('user', $admin);
            Session::put('role', $admin->maPhanQuyen);
            Session::put('maNguoiDung', $admin->maNguoiDung);

            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('error', 'Đăng nhập thất bại');
    }

    public function logout()
    {
        session()->forget('user');
        session()->forget('role');
        session()->forget('maNguoiDung');

        return redirect()->route('login');
    }
}
