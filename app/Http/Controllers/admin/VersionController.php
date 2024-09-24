<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVersionRequest;
use App\ServicesAdmin\VersionAdmin\CreateVersion;
use App\ServicesAdmin\VersionAdmin\IndexVersion;

class VersionController extends Controller
{
    private $indexVersion;
    private $createVersion;

    public function __construct(
        IndexVersion $indexVersion,
        CreateVersion $createVersion,
    ) {
        $this->indexVersion = $indexVersion;
        $this->createVersion = $createVersion;
    }

    public function index()
    {
        return $this->indexVersion->index();
    }

    public function create()
    {
        return $this->createVersion->create();
    }

    public function store(CreateVersionRequest $request)
    {
        return $this->createVersion->store($request);
    }
}
