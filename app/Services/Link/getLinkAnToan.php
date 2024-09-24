<?php
namespace App\Services\Link;

use App\Models\link;

class getLinkAnToan
{
    public function handle()
    {
        $listId = [14];

        $linkantoan = link::whereIn('maLink', $listId)->get();

        return $linkantoan;
    }
}