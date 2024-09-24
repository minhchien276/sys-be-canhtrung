<?php
namespace App\Services\HutSua;

use App\Models\hutsua;

class findHutSua
{
    public function handle($id)
    {
        $hutsua = hutsua::where('id', $id->orderBy('thoiGian', 'desc'))->get();

        return $hutsua;
    }
}