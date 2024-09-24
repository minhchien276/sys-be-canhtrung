<?php
namespace App\Services\CauTraLoi;

use App\Models\cautraloi;

class updateCauTraLoi
{
    public function handle($request, $id)
    {
        $ctl = cautraloi::where('maCauTraLoi', $id)->update([
            'cauTraLoi' => $request->cauTraLoi,
        ]);

        return $ctl;
    }
}