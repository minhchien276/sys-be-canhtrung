<?php
namespace App\Services\Video;

use Illuminate\Support\Facades\DB;

class getVideoTest
{
    public function handle()
    {
        $id = [3, 6, 9, 30, 33];

        $video = DB::table('video')->whereIn('id', $id)->get();

        return $video;
    }
}