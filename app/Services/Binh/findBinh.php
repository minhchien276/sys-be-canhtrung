<?php
namespace App\Services\Binh;

use App\Models\binh;

class findBinh 
{
    public function handle($id)
    {
        $binh = binh::find($id);

        return $binh;
    }
}