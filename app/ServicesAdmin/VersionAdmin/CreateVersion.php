<?php

namespace App\ServicesAdmin\VersionAdmin;

use App\Models\version;
use Carbon\Carbon;

class CreateVersion
{
    public function create()
    {
        return view('admin.version.create');
    }

    public function store($request)
    {
        $update_at = Carbon::now();

        $milliseconds = $update_at->timestamp * 1000;

        version::create([
            'version_id' => $request->version_id,
            'content' => $request->content,
            'update_at' => $milliseconds,
        ]);

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
