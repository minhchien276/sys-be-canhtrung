<?php

namespace App\Services\TrieuChung;

use App\Models\trieuchung;
use Illuminate\Support\Facades\DB;

class createTrieuChung
{
    public function handle($request)
    {
        trieuchung::updateOrInsert(
            ['id_con' => $request->id_con],
            ['dauHieu' => $request->dauHieu]
        );

        $trieuchung = trieuchung::where('id_con', $request->id_con)->get();

        return $trieuchung;
    }
}
