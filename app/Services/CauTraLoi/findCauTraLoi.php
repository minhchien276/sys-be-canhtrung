<?php
namespace App\Services\CauTraLoi;

use App\Models\cautraloi;

class findCauTraLoi
{
    public function handle($maNhatKy)
    {
        $ctl = cautraloi::where('maNhatKy', $maNhatKy)->get();

        return $ctl;
    }
}