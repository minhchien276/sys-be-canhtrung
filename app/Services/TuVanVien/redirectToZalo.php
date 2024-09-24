<?php

namespace App\Services\TuVanVien;

use App\Models\tuvanvien;

class redirectToZalo
{
    public function redirectToZalo($request, $maTvv)
    {
        $tuvanvien = tuvanvien::where('maTvv', $maTvv)->first();

        if ($tuvanvien) {
            $linkZalo = $tuvanvien->linkZalo;

            $soDienThoai = $tuvanvien->soDienThoai;

            $userAgent = $request->header('User-Agent');

            if (stripos($userAgent, "iPod") !== false || stripos($userAgent, "iPhone") !== false) {
                return redirect("zalo://qr/p/" . $linkZalo);
            } elseif (stripos($userAgent, "iPad") !== false) {
                return redirect("zalo://qr/p/" . $linkZalo);
            } elseif (stripos($userAgent, "Android") !== false) {
                return redirect("https://zaloapp.com/qr/p/" . $linkZalo);
            } elseif (stripos($userAgent, "webOS") !== false) {
                return redirect("zalo://conversation?phone=" . $soDienThoai);
            } else {
                return redirect("zalo://conversation?phone=" . $soDienThoai);
            }
        } else {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin tư vấn viên.');
        }
    }
}
