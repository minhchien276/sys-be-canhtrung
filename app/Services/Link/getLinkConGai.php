<?php
namespace App\Services\Link;

use App\Models\link;

class getLinkConGai
{
    public function handle()
    {
        $listId = [2];

        $linkcongai = link::whereIn('maLink', $listId)->get();

        return $linkcongai;
    }
}