<?php

namespace App\Services\Address;

use App\Models\address;

class getAllAddress
{
    public function handle($maNguoiDung)
    {
        $address = address::where('maNguoiDung', $maNguoiDung)
            ->orderBy('status', 'desc')
            ->get();

        return $address;
    }
}
