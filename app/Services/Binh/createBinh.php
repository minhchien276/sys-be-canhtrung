<?php
namespace App\Services\Binh;

use App\Models\binh;

class createBinh 
{
    public function handle($request)
    {
        $binh = binh::create([
            "lop" => $request->lop,
            "khoangCach" => $request->khoangCach,
            "MaBinh" => $request->MaBinh,
        ]);

        return $binh;
    }
}