<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class createKinhNguyet
{
    public function handle($request)
    {
        $data = $request->json()->all();

        $records = [];

        foreach ($data as $item) {
            $records[] = [
                'maNguoiDung' => $item['maNguoiDung'],
                'tbnkn' => $item['tbnkn'],
                'snck' => $item['snck'],
                'snct' => $item['snct'],
                'ckdn' => $item['ckdn'],
                'cknn' => $item['cknn'],
                'ngayBatDau' => $item['ngayBatDau'],
                'ngayKetThuc' => $item['ngayKetThuc'],
                'ngayBatDauKinh' => $item['ngayBatDauKinh'],
                'ngayKetThucKinh' => $item['ngayKetThucKinh'],
                'ngayBatDauTrung' => $item['ngayBatDauTrung'],
                'ngayKetThucTrung' => $item['ngayKetThucTrung'],
                'trangThai' => $item['trangThai'],
            ];
        }

        $kinhnguyet = kinhnguyet::insert($records);

        return $kinhnguyet;
    }
}
