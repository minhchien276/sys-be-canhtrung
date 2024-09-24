<?php

namespace App\Services\Connnnn;

use App\Models\connnnn;
use Illuminate\Support\Facades\DB;

class updateTrangThai
{
    public function handle($id, $maNguoiDung)
    {
        $connnnn = connnnn::find($id);

        if ($connnnn) {
            $connnnn->trangThai = 1;
            $connnnn->save();

            DB::table('connnnn')
                ->where('maNguoiDung', $maNguoiDung)
                ->where('id', '<>', $id)
                ->update(['trangThai' => 0]);
        }

        return $connnnn;
    }
}
