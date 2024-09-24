<?php

namespace App\Services\Auth;

use App\Models\nguoidung;

class getAllUsers
{
    public function handle()
    {
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $users = nguoidung::join('phanquyen', 'nguoidung.maPhanQuyen', '=', 'phanquyen.maPhanQuyen')
                ->select('nguoidung.*', 'phanquyen.*')
                ->get();

            $data[] = [
                'user' => $users,
            ];
        }

        return $data;
    }
}
