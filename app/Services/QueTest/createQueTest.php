<?php
namespace App\Services\QueTest;

use App\Models\quetest;

class createQueTest
{
    public function handle($request)
    {
        $quetest = quetest::create([
            'maLoaiQue' => $request->maLoaiQue,
            'tenQue' => $request->tenQue,
        ]);

        return $quetest;
    }
}