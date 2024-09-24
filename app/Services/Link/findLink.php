<?php
namespace App\Services\Link;

use App\Models\link;

class findLink 
{
    public function handle($id)
    {
        $link = link::find($id);

        return $link;
    }
}