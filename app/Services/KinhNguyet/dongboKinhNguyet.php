<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class dongboKinhNguyet
{
    public function handle($request, $id)
    {
        $KNserver = kinhnguyet::where('maNguoiDung', $id)->get();

        $KNlocal = $request->json()->all();

        $records = [];

        if (count($KNserver) != count($KNlocal)) {
            kinhnguyet::where('maNguoiDung', $id)->delete();

            foreach ($KNlocal as $item) {
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
        } else {
            for ($i = 0; $i < count($KNserver); $i++) {
                $kinhnguyet = kinhnguyet::where('maKinhNguyet', $KNserver[$i]->maKinhNguyet)->update($KNlocal[$i]);
            }
            return true;
        }
    }
}
