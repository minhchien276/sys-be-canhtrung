<?php
namespace App\Services\CauTraLoi;

use App\Models\cautraloi;

class createCauTraLoi
{
    public function handle($request)
    {
        $data = $request->json()->all();

        $records = [];

        foreach ($data as $item) {
            $records[] = [
                'maNhatKy' => $item['maNhatKy'],
                'maCauHoi' => $item['maCauHoi'],
                'cauTraLoi' => $item['cauTraLoi'],
            ];
        }

        $ctl = cautraloi::insert($records);

        return $ctl;
    }
}