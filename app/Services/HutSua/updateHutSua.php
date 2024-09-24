<?php
namespace App\Services\HutSua;

use App\Models\hutsua;

class updateHutSua
{
    public function handle($request, $id)
    {
        $hutsua = hutsua::where('id', $id)->update([
            "vuTrai" => $request->vuTrai,
            "vuPhai" => $request->vuPhai,
        ]);

        return $hutsua;
    }
}