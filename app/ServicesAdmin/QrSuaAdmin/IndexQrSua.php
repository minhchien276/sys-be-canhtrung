<?php

namespace App\ServicesAdmin\QrSuaAdmin;

use App\Models\qrsua;

class IndexQrSua
{
    public function showQrSua()
    {
        $qrsua = qrsua::get();

        return view('admin.qrsua.index', compact('qrsua'));
    }

    public function loadListQrSua()
    {
        $qrsua = qrsua::get();

        return view('admin.qrsua.loadListQrSua', compact('qrsua'));
    }
}
