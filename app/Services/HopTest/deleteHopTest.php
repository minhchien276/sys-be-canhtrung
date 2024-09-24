<?php
namespace App\Services\HopTest;

use App\Models\hoptest;

class deleteHopTest
{
    public function handle($id)
    {
        $hoptest = hoptest::where('maHopTest', $id)->delete();

        return $hoptest;
    }
}