<?php
namespace App\Services\LichKham;

use App\Models\lichkham;

class updateLichKham
{
    public function handle($request, $id)
    {
        $lichkham = lichkham::where('id', $id)->update([
            "id_phongkham" => $request->id_phongkham,
            "maNguoiDung" => $request->maNguoiDung,
            "id_tvv" => $request->id_tvv,
            "phone" => $request->phone,
            "datetime" => $request->datetime,
            "status" => $request->status,
            "id_benh" => $request->id_benh,
        ]);

        return $lichkham;
    }
}