<?php

namespace App\Services\NhatKy;

use App\Models\cautraloi;
use App\Models\nhatky;

class dongBoNhatKy
{
    public function handle($request, $maNguoiDung)
    {
        $allData = $request->json()->all();
        $nhatkyArray = $allData['nhatky'];

        foreach ($nhatkyArray as $nhatky) {
            $maNhatKy = $nhatky['maNhatKy'];
            $thoiGian = $nhatky['thoiGian'];
            $tonTai = $nhatky['tonTai'];

            nhatky::updateOrInsert(
                ['maNhatky' => $maNhatKy, 'maNguoiDung' => $maNguoiDung, 'thoiGian' => $thoiGian],
                ['tonTai' => $tonTai]
            );


            $cauTraLoiArray = $nhatky['cauTraLoi'];
            foreach ($cauTraLoiArray as $cauTraLoi) {
                $maCauHoi = $cauTraLoi['maCauHoi'];
                $cauTraLoiText = $cauTraLoi['cauTraLoi'];

                $res = cautraloi::updateOrInsert(
                    ['maNhatKy' => $maNhatKy, 'maCauHoi' => $maCauHoi],
                    ['cauTraLoi' => $cauTraLoiText]
                );
            }
        }

        $status = $res ? true : false;

        return response()->json(['status' => $status], $status ? 200 : 400);
    }
}
