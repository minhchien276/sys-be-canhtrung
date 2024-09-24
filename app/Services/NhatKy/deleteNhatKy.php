<?php
namespace App\Services\NhatKy;

use App\Models\cautraloi;
use App\Models\nhatky;

class deleteNhatKy
{
    public function handle($id)
    {
        cautraloi::where('maNhatKy', $id)->delete();

        $nhatky = nhatky::where('maNhatKy', $id)->update([
            'tonTai' => 1
        ]);

        return $nhatky;
    }
}
