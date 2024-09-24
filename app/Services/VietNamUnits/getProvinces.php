<?php
namespace App\Services\VietNamUnits;

use Illuminate\Support\Facades\DB;

class getProvinces
{
    public function handle()
    {
        $provinces = DB::table('provinces')->get();

        return $provinces;
    }
}