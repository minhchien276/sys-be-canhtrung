<?php
namespace App\Services\Video;

use Illuminate\Support\Facades\DB;

class getTestImage
{
    public function handle()
    {
        $id = [12, 15, 18, 21, 24];

        $video = DB::table('video')->whereIn('id', $id)->get();

        return $video;
    }
}