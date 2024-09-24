<?php

namespace App\Services\KinhNguyet;

use App\Models\kinhnguyet;

class deleteKinhNguyetByDate
{
    public function handle($maNguoiDung, $request)
    {
        $allData = $request->json()->all();
        $kinhNguyetDelete = $allData['kinhNguyetDelete'];
        $kinhNguyetUpdate = $allData['kinhNguyetUpdate'];

        foreach ($kinhNguyetDelete as $item) {
            $ngayBatDau = $item['ngayBatDau'];
            $ngayKetThuc = $item['ngayKetThuc'];

            kinhnguyet::where('maNguoiDung', $maNguoiDung)
                ->where('ngayBatDau', $ngayBatDau)
                ->where('ngayKetThuc', $ngayKetThuc)
                ->delete();
        }

        $KNserver = kinhnguyet::where('maNguoiDung', $maNguoiDung)->get();

        if (count($kinhNguyetUpdate) != count($KNserver)) {
            foreach ($kinhNguyetUpdate as $item) {
                $ngayBatDau = $item['ngayBatDau'];
                $ngayKetThuc = $item['ngayKetThuc'];

                kinhnguyet::where('maNguoiDung', $maNguoiDung)
                    ->where('ngayBatDau', $ngayBatDau)
                    ->where('ngayKetThuc', $ngayKetThuc)
                    ->delete();
            }

            foreach ($kinhNguyetUpdate as $item) {
                kinhnguyet::create([
                    'maNguoiDung' => $maNguoiDung,
                    "tbnkn" => $item['tbnkn'],
                    "snck" => $item['snck'],
                    "snct" => $item['snct'],
                    "ckdn" => $item['ckdn'],
                    "cknn" => $item['cknn'],
                    "ngayBatDau" => $item['ngayBatDau'],
                    "ngayKetThuc" => $item['ngayKetThuc'],
                    "ngayBatDauKinh" => $item['ngayBatDauKinh'],
                    "ngayKetThucKinh" => $item['ngayKetThucKinh'],
                    "ngayBatDauTrung" => $item['ngayBatDauTrung'],
                    "ngayKetThucTrung" => $item['ngayKetThucTrung'],
                    "trangThai" => $item['trangThai'],
                ]);
            }
        } elseif (count($kinhNguyetUpdate) == count($KNserver)) {
            for ($i = 0; $i < count($KNserver); $i++) {
                kinhnguyet::where('maKinhNguyet', $KNserver[$i]->maKinhNguyet)->update($kinhNguyetUpdate[$i]);
            }
        }

        return response()->json([
            'status' => true
        ], 200);
    }
}
