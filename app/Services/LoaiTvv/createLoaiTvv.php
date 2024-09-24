<?php
namespace App\Services\LoaiTvv;

use App\Models\loaitvv;

class createLoaiTvv
{
    public function handle($request)
    {     
        $loaiTvv = loaitvv::create([
            "type" => $request->type,
        ]);

        return $loaiTvv;
    }
}