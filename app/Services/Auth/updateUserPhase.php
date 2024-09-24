<?php

namespace App\Services\Auth;

use App\Models\nguoidung;

class updateUserPhase
{
    public function handle($request, $id)
    {
        $check = nguoidung::where('maNguoiDung', $id)->update([
            'phase' => $request->phase,
        ]);

        return $check;
    }
}
