<?php
namespace App\Services\VietNamUnits;

use Illuminate\Support\Facades\DB;

class getWards 
{
    public function handle($district_code)
    {
        $wards = DB::table('wards')->where('district_code', $district_code)->get();

        return $wards;
    }
}