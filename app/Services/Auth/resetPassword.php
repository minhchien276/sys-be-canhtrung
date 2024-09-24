<?php

namespace App\Services\Auth;

use App\Models\nguoidung;
use Illuminate\Support\Facades\Hash;

class resetPassword
{
    public function handle($request, $id)
    {
        $user = nguoidung::where('maNguoiDung', $id)->first();

        if ($user && Hash::check($request->matKhau, $user->matKhau)) {
            $data = nguoidung::where('maNguoiDung', $id)->update([
                'matKhau' => bcrypt($request->matKhauMoi),
            ]);
            if ($data) {
                return response()->json([
                    'message' => 'change password successfully',
                    'status' => true
                ], 200);
            }
        }

        return response()->json([
            'message' => 'User not found',
            'status' => false
        ], 404);
    }
}
