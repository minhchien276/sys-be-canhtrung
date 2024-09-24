<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVideoRequest;
use App\ServicesAdmin\VideoAdmin\CreateVideo;
use App\ServicesAdmin\VideoAdmin\EditVideo;
use App\ServicesAdmin\VideoAdmin\IndexVideo;

class VideoController extends Controller
{
    private $indexVideo;
    private $createVideo;
    private $editVideo;

    public function __construct(
        IndexVideo $indexVideo,
        CreateVideo $createVideo,
        EditVideo $editVideo,
    ) {
        $this->indexVideo = $indexVideo;
        $this->createVideo = $createVideo;
        $this->editVideo = $editVideo;
    }

    public function index()
    {
        return $this->indexVideo->index();
    }

    public function create()
    {
        return $this->createVideo->create();
    }

    public function store(CreateVideoRequest $request)
    {
        return $this->createVideo->store($request);
    }

    public function edit($id)
    {
        return $this->editVideo->edit($id);
    }

    public function update(CreateVideoRequest $request, $id)
    {
        return $this->editVideo->update($request, $id);
    }
}
