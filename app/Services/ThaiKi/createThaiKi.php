<?php
namespace App\Services\ThaiKi;

use App\Models\thaiki;

class createThaiKi
{
    public function handle($request)
    {
        $tonTai = thaiki::where('maNguoiDung', $request->maNguoiDung)->first();
        
        if (!$tonTai)
        {
            $thaiki = thaiki::create([
                'maNguoiDung' => $request->maNguoiDung,
                'ngayQuanHe' => $request->ngayQuanHe,
                'ngayDuSinh' => $request->ngayDuSinh,
                'ngayTestThuThai' => $request->ngayTestThuThai,
                'ketQuaVangDa' => $request->ketQuaVangDa,
            ]);
        }
        
        $thaiki = thaiki::where('maNguoiDung', $request->maNguoiDung)->update([
            'ngayDuSinh' => $request->ngayDuSinh,
        ]);
        
        return $thaiki;
    }
}