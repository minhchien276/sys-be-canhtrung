<?php
namespace App\Services\QueTest;

use App\Models\quetest;

class updateQueTest
{
    public function handle($request, $id)
    {
        $quetest = quetest::where('maLoaiQue', $id)->update([
            'tenQue' => $request->tenQue,
        ]);

        return $quetest;
    }
}