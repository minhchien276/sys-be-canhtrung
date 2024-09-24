<?php
namespace App\Services\Binh;

use App\Models\binh;

class updateBinh 
{
    public function handle($request, $id)
    {
        $binh = binh::where('id', $id)->update([
            "lop" => $request->lop,
            "khoangCach" => $request->khoangCach,
            "MaBinh" => $request->MaBinh,
        ]);

        return $binh;
    }
}