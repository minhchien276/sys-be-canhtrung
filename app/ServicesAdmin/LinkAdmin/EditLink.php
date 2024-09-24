<?php

namespace App\ServicesAdmin\LinkAdmin;

use App\Models\link;

class EditLink
{
    public function update($request, $id)
    {
        $link = link::all();

        link::where('maLink', $id)->update([
            'tenLink' => $request->tenLink,
            'title' => $request->title,
            'description' => $request->description,
            'member' => $request->member,
            'image' => $request->image,
        ]);

        return view('admin.link.link', compact('link'));
    }

    public function edit($id)
    {
        $link = link::find($id);

        return view('admin.link.editLink', compact('link'));
    }
}
