<?php
namespace App\Services\QuangCao;

use App\Models\quangcao;

class updateQuangCao 
{
    public function handle($request, $id)
    {
        $quangcao = quangcao::where('id', $id)->update([
            "image" => $request->image,
            "phase" => $request->phase,
            "type" => $request->type,
            "status" => $request->status,
            "link" => $request->link,
        ]);

        return $quangcao;
    }
}