<?php

namespace App\ServicesAdmin\SlideAdmin;

use App\Models\slide;
use Carbon\Carbon;

class CreateSlide
{
    public function create()
    {
        return view('admin.slide.createSlide');
    }

    public function store($request)
    {
        $created_at = Carbon::now()->format('d-m-Y H:i:s');

        $milliseconds = strtotime($created_at) * 1000;

        slide::create([
            'title' => $request->title,
            'image' => $request->image,
            'status' => $request->status,
            'created_at' => $milliseconds,
        ]);

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
