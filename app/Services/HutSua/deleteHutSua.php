<?php
namespace App\Services\HutSua;

use App\Models\hutsua;

class deleteHutSua
{
    public function handle($id)
    {
        $hutsua = hutsua::where('id', $id)->delete();

        return $hutsua;
    }
}