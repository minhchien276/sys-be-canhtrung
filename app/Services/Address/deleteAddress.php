<?php

namespace App\Services\Address;

use App\Models\address;

class deleteAddress
{
    public function handle($id, $maNguoiDung)
    {
        $address = address::where('id', $id)->where('maNguoiDung', $maNguoiDung)->delete();

        return $address;
    }
}
