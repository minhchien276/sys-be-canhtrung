<?php

namespace App\ServicesAdmin\SlideAdmin;

use App\Models\slide;
use Carbon\Carbon;

class EditSlide
{
    public function edit($id)
    {
        $slide = slide::find($id);

        return view('admin.slide.editSlide', compact('slide'));
    }

    public function update($request, $id)
    {
        slide::where('id', $id)->update([
            'title' => $request->title,
            'image' => $request->image,
            'status' => $request->status,
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
