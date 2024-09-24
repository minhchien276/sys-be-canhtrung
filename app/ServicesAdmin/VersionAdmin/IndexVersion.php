<?php

namespace App\ServicesAdmin\VersionAdmin;

use App\Models\version;
use Carbon\Carbon;

class IndexVersion
{
    public function index()
    {
        $version = version::get();

        $version->map(function ($item) {
            if ($item->update_at) {
                $update_at = Carbon::createFromTimestamp($item->update_at / 1000);
                $item->update_at = $update_at->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.version.index', compact('version'));
    }
}
