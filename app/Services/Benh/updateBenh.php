<?php
namespace App\Services\Benh;

use App\Models\benh;

class updateBenh 
{
    public function handle($request, $id)
    {
        $benh = benh::where('id', $id)->update([
            "name" => $request->name,
        ]);

        return $benh;
    }
}