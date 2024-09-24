<?php
namespace App\Services\Video;

use Illuminate\Support\Facades\DB;

class getLinkMusic
{
    public function handle()
    {
        $video = DB::table('video')->where('id', 45)->get();

        return $video;
    }
}