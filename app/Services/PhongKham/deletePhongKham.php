<?php
namespace App\Services\PhongKham;

use App\Models\phongkham;

class deletePhongKham
{
    public function handle($id)
    {
        $phongkham = phongkham::where('id', $id)->delete();

        return $phongkham;
    }
}