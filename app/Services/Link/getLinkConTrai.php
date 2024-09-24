<?php
namespace App\Services\Link;

use App\Models\link;

class getLinkConTrai 
{
    public function handle()
    {
        $listId = [1];

        $linkcontrai = link::whereIn('maLink', $listId)->get();

        return $linkcontrai;
    }
}