<?php
namespace App\Services\LichKham;

use App\Models\lichkham;

class deleteLichKham 
{
    public function handle($id)
    {
        $lichkham = lichkham::where('id', $id)->delete();

        return $lichkham;
    }
}