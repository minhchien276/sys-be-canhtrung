<?php
namespace App\Services\HopTest;

use App\Models\hoptest;

class createHopTest
{
    public function handle($request)
    {
        $hoptest = hoptest::create([
            "maHopTest" => $request->maHopTest,
        ]);

        return $hoptest;
    }
}