<?php

namespace App\ServicesAdmin\ClickLink;

use Illuminate\Support\Facades\DB;

class IndexClickLink
{
    public function index($request)
    {
        $thoiGian = $request->input('thoiGian');
        $thoiGianTu = $request->input('thoiGianTu');
        $thoiGianDen = $request->input('thoiGianDen');

        $click = DB::table('clicklink')
            ->join('link', 'clicklink.id_link', '=', 'link.maLink')
            ->select('link.tenLink', 'link.title', 'clicklink.id_link', DB::raw('COUNT(*) as count_records'))
            ->groupBy('link.tenLink', 'link.title', 'clicklink.id_link')
            ->get();

        return view('admin.clicklink.clicklink', compact('click', 'thoiGian', 'thoiGianDen', 'thoiGianTu'));
    }
}
