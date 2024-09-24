<?php
namespace App\Services\VietNamUnits;

use Illuminate\Support\Facades\DB;

class getDistricts 
{
    public function handle($province_code)
    {
        $districts = DB::table('districts')->where('province_code', $province_code)->get();

        return $districts;
    }
}