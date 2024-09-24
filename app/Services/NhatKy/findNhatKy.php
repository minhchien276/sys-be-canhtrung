<?php

namespace App\Services\NhatKy;

use App\Models\cautraloi;
use App\Models\nhatky;

class findNhatKy
{
    public function handle($id)
    {
        $listNhatKy = nhatky::where('maNguoiDung', $id)
            ->where('tonTai', 0)
            ->get();

        foreach ($listNhatKy as $nhatKy) {
            $clt = cautraloi::where('maNhatKy', $nhatKy->maNhatKy)
                ->pluck('cautraloi')
                ->toArray();
            $nhatKy->cauTraLoi = $clt;
        }

        return $listNhatKy;
    }
}
