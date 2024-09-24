<?php
namespace App\Services\Version;

use App\Models\version;

class createVersion
{
    public function handle($request)
    {
        $version = version::create([
            'version_id' => $request->version_id,
            'content' => $request->content,
            'update_at' => $request->update_at,
        ]);

        return $version;
    }
}