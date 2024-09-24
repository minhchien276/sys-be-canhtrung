<?php

namespace App\ServicesAdmin\MilkAdmin;

use App\Models\hutsua;
use Carbon\Carbon;

class MilkService {

    public function getBreastMilk($id) {

        $data = hutsua::where('maNguoiDung', $id)->get();
        $data->map(function ($item) {
            $item->thoiGian = Carbon::createFromTimestamp($item->thoiGian / 1000)->toDateTimeString();
            return $item;
        });
        return view('admin.users.milks', compact('data'));
    }
}