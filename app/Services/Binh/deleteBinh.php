<?php
namespace App\Services\Binh;

use App\Models\binh;

class deleteBinh
{
    public function handle($id)
    {
        $binh = binh::where('id', $id)->delete();

        return $binh;
    }
}