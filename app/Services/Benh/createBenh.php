<?php
namespace App\Services\Benh;

use App\Models\benh;

class createBenh 
{
    public function handle($request)
    {
        $benh = benh::create([
            "name" => $request->name,
        ]);

        return $benh;
    }
}