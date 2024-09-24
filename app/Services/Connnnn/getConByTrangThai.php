<?php

namespace App\Services\Connnnn;

use App\Models\connnnn;

class getConByTrangThai
{
    public function handle($id)
    {
        $connnnn = connnnn::where('maNguoiDung', $id)->where('trangThai', 1)->get();

        return $connnnn;
    }
}
