<?php

namespace App\ServicesAdmin\ClickLink;

use Illuminate\Support\Facades\DB;

class CheckClick
{
    public function checkClicks($request)
    {
        $thoiGian = $request->input('thoiGian');
        $thoiGianTu = $request->input('thoiGianTu');
        $thoiGianDen = $request->input('thoiGianDen');

        $click = DB::table('clicklink')
            ->join('link', 'clicklink.id_link', '=', 'link.maLink')
            ->select('link.tenLink', 'link.title', 'clicklink.id_link', DB::raw('COUNT(*) as count_records'))
            ->where('thoiGian', $thoiGian)
            ->groupBy('link.tenLink', 'link.title', 'clicklink.id_link')
            ->get();

        return view('admin.clicklink.clicklink', compact('click', 'thoiGian', 'thoiGianDen', 'thoiGianTu'));
    }

    public function checkClicksMonth($request)
    {
        $thoiGian = $request->input('thoiGian');
        $thoiGianTu = $request->input('thoiGianTu');
        $thoiGianDen = $request->input('thoiGianDen');

        $click = DB::table('clicklink')
            ->join('link', 'clicklink.id_link', '=', 'link.maLink')
            ->select('link.tenLink', 'link.title', 'clicklink.id_link', DB::raw('COUNT(*) as count_records'))
            ->whereBetween('thoiGian', [$thoiGianTu, $thoiGianDen])
            ->groupBy('link.tenLink', 'link.title', 'clicklink.id_link')
            ->get();

        return view('admin.clicklink.clicklink', compact('click', 'thoiGian', 'thoiGianDen', 'thoiGianTu'));
    }
}
