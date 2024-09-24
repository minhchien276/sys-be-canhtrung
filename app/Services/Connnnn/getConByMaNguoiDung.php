<?php

namespace App\Services\Connnnn;

use App\Models\connnnn;

class getConByMaNguoiDung
{
    public function handle($id)
    {
        $connnnn = connnnn::where('maNguoiDung', $id)->orderBy('trangThai', 'desc')->get();

        return $connnnn;
    }
}
