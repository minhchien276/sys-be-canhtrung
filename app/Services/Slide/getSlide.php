<?php
namespace App\Services\Slide;

use App\Models\slide;

class getSlide 
{
    public function handle()
    {
        $slide = slide::all();

        return $slide;
    }
}