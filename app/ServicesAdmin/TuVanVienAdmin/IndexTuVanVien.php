<?php

namespace App\ServicesAdmin\TuVanVienAdmin;

use App\Models\loaitvv;
use App\Models\tuvanvien;

class IndexTuVanVien
{
    public function index()
    {
        $tvv = tuvanvien::all();

        $loaitvv = loaitvv::all();

        $thongbao = '';

        $user = [];

        return view('admin.tuvanvien.listTvv', compact('tvv', 'loaitvv', 'user', 'thongbao'));
    }
}
