<?php
namespace App\Services\QuangCao;

use App\Models\quangcao;

class createQuangCao 
{
    public function handle($request)
    {
        $quangcao = quangcao::create([
            "image" => $request->image,
            "phase" => $request->phase,
            "type" => $request->type,
            "status" => $request->status,
            "link" => $request->link,
        ]);

        return $quangcao;
    }
}