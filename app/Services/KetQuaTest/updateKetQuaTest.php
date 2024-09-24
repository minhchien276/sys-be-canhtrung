<?php
namespace App\Services\KetQuaTest;

use App\Models\ketquatest;

class updateKetQuaTest
{
    public function handle($request, $id)
    {
        $ketquatest = ketquatest::where('maKetQuaTest', $id)->update([
            "ketQua" => $request->ketQua,
        ]);

        return $ketquatest;
    }
}