<?php
namespace App\Services\Link;

use App\Models\link;

class getLinkMeBe 
{
    public function handle()
    {
        $listId = [34];

        $linkmebe = link::whereIn('maLink', $listId)->get();

        return $linkmebe;
    }
}