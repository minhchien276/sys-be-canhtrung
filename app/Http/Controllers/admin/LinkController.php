<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\link;
use App\ServicesAdmin\LinkAdmin\CreateLink;
use App\ServicesAdmin\LinkAdmin\EditLink;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    private $createLink;
    private $editLink;

    public function __construct(
        CreateLink $createLink,
        EditLink $editLink,
    ) {
        $this->createLink = $createLink;
        $this->editLink = $editLink;
    }

    public function show()
    {
        $link = link::all();

        return view('admin.link.link', compact('link'));
    }

    public function create(Request $request)
    {
        return $this->createLink->create($request);
    }

    public function loadLinkList()
    {
        $link = link::all();

        return view('admin.link.linkList', compact('link'));
    }

    public function update(UpdateLinkRequest $request, $id)
    {
        return $this->editLink->update($request, $id);
    }

    public function edit($id)
    {
        return $this->editLink->edit($id);
    }
}
