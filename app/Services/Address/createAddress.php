<?php

namespace App\Services\Address;

use App\Models\address;

class createAddress
{
    public function handle($request)
    {
        if ($request->status == 1) {
            address::where('maNguoiDung', $request->maNguoiDung)->update(['status'=> 0]);

            $address = address::create([
                'provinces' => $request->provinces,
                'districts' => $request->districts,
                'wards' => $request->wards,
                'address_specific' => $request->address_specific,
                'maNguoiDung' => $request->maNguoiDung,
                'username' => $request->username,
                'phone' => $request->phone,
                'provinceId' => $request->provinceId,
                'districtId' => $request->districtId,
                'wardId' => $request->wardId,
                'status' => 1,
            ]);

            return $address;
        }

        $address = address::create([
            'provinces' => $request->provinces,
            'districts' => $request->districts,
            'wards' => $request->wards,
            'address_specific' => $request->address_specific,
            'maNguoiDung' => $request->maNguoiDung,
            'username' => $request->username,
            'phone' => $request->phone,
            'provinceId' => $request->provinceId,
                'districtId' => $request->districtId,
                'wardId' => $request->wardId,
            'status' => 0,
        ]);

        return $address;
    }
}
