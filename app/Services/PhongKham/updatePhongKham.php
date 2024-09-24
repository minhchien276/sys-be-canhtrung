<?php
namespace App\Services\PhongKham;

use App\Models\phongkham;

class updatePhongKham
{
    public function handle($request, $id)
    {
        $phongkham = phongkham::where('id', $id)->update([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone
        ]);

        return $phongkham;
    }
}