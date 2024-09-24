<?php
namespace App\Services\PhongKham;

use App\Models\phongkham;

class createPhongKham 
{
    public function handle($request)
    {
        $phongkham = phongkham::create([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone,
        ]);

        return $phongkham;
    }
}