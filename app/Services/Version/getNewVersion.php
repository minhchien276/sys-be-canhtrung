<?php
namespace App\Services\Version;

use App\Models\version;

class getNewVersion
{
    public function handle()
    {
        $version = version::orderBy('update_at', 'desc')->first();

        return $version;
    }
}