<?php

namespace App\ServicesAdmin\QuangCaoAdmin;

use App\Models\quangcao;
use Illuminate\Support\Facades\DB;

class IndexQuangCao
{
    public function index()
    {
        $quangcao = quangcao::leftJoin('clickads', 'quangcao.id', '=', 'clickads.id_quangcao')
            ->select('quangcao.id', 'quangcao.image', 'quangcao.phase', 'quangcao.type', 'quangcao.status', DB::raw('COUNT(clickads.id_quangcao) as count_records'))
            ->groupBy('quangcao.id', 'quangcao.image', 'quangcao.phase', 'quangcao.type', 'quangcao.status')
            ->get();

        return view('admin.quangcao.quangCao', compact('quangcao'));
    }

    public function loadQuangCaoList()
    {
        $quangcao = quangcao::all();

        return view('admin/listQuangCao', compact('quangcao'));
    }
}
