<?php

namespace App\Services\Address;

use App\Models\address;

class updateStatusAddress
{
    public function handle($id, $maNguoiDung)
    {
        address::where('maNguoiDung', $maNguoiDung)->update(['status' => 0]);

        $address = address::where('id', $id)
            ->where('maNguoiDung', $maNguoiDung)->update([
                'status' => 1,
            ]);

        return $address;
    }
}
