<?php

namespace App\ServicesAdmin\SlideAdmin;

use App\Models\slide;
use Carbon\Carbon;

class IndexSlide
{
    public function index()
    {
        $slides = slide::all();

        $slides->map(function ($item) {
            if ($item->created_at) {
                $created_at = Carbon::createFromTimestamp($item->created_at / 1000);
                $item->created_at = $created_at->format('d-m-Y H:i:s');
            }

            return $item;
        });

        return view('admin.slide.indexSlide', compact('slides'));
    }
}
