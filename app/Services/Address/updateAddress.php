<?php

namespace App\Services\Address;

use App\Models\address;

class updateAddress
{
    public function handle($request, $id, $maNguoiDung)
    {
        if ($request->status == 1) {
            address::where('maNguoiDung', $request->maNguoiDung)->update(['status' => 0]);

            $address = address::where('id', $id)
                ->where('maNguoiDung', $maNguoiDung)->update([
                    'provinces' => $request->provinces,
                    'districts' => $request->districts,
                    'wards' => $request->wards,
                    'address_specific' => $request->address_specific,
                    'username' => $request->username,
                    'phone' => $request->phone,
                    'status' => $request->status,
                    'provinceId' => $request->provinceId,
                    'districtId' => $request->districtId,
                    'wardId' => $request->wardId,
                ]);

            return $address;
        }

        $address = address::where('id', $id)
            ->where('maNguoiDung', $maNguoiDung)->update([
                'provinces' => $request->provinces,
                'districts' => $request->districts,
                'wards' => $request->wards,
                'address_specific' => $request->address_specific,
                'username' => $request->username,
                'phone' => $request->phone,
                'status' => $request->status,
                'provinceId' => $request->provinceId,
                'districtId' => $request->districtId,
                'wardId' => $request->wardId,
            ]);

        return $address;
    }
}
