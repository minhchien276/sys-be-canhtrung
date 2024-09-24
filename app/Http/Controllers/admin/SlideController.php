<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\ServicesAdmin\SlideAdmin\CreateSlide;
use App\ServicesAdmin\SlideAdmin\EditSlide;
use App\ServicesAdmin\SlideAdmin\IndexSlide;

class SlideController extends Controller
{
    private $indexSlide;
    private $createSlide;
    private $editSlide;

    public function __construct(
        IndexSlide $indexSlide,
        CreateSlide $createSlide,
        EditSlide $editSlide,
    ) {
        $this->indexSlide = $indexSlide;
        $this->createSlide = $createSlide;
        $this->editSlide = $editSlide;
    }

    public function index()
    {
        return $this->indexSlide->index();
    }

    public function create()
    {
        return $this->createSlide->create();
    }

    public function store(CreateSlideRequest $request)
    {
        return $this->createSlide->store($request);
    }

    public function edit($id)
    {
        return $this->editSlide->edit($id);
    }

    public function update(UpdateSlideRequest $request, $id)
    {
        return $this->editSlide->update($request, $id);
    }
}
