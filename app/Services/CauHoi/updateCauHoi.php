<?php
namespace App\Services\CauHoi;

use App\Models\cauhoi;

class updateCauHoi
{
    public function handle($request, $id)
    {
        $cauhoi = cauhoi::where('maCauHoi', $id)->update([
            'noiDung' => $request->noiDung,
        ]);

        return $cauhoi;
    }
}