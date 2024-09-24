<?php

namespace App\Services\TrieuChung;

use App\Models\trieuchung;

class getTrieuChung
{
    public function handle($id_con)
    {
        $trieuchung = trieuchung::where('id_con', $id_con)->get();

        return $trieuchung;
    }
}
