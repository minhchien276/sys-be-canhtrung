<?php
namespace App\Services\Link;

use App\Models\link;

class deleteLink 
{
    public function handle($id)
    {
        $link = link::find($id)->delete();

        return $link;
    }
}