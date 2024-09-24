<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateQuangCaoRequest;
use App\ServicesAdmin\QuangCaoAdmin\CreateQuangCao;
use App\ServicesAdmin\QuangCaoAdmin\EditQuangCao;
use App\ServicesAdmin\QuangCaoAdmin\IndexQuangCao;
use Illuminate\Http\Request;

class QuangCaoController extends Controller
{
    private $indexQuangCao;
    private $createQuangCao;
    private $editQuangCao;

    public function __construct(
        IndexQuangCao $indexQuangCao,
        CreateQuangCao $createQuangCao,
        EditQuangCao $editQuangCao,
    ) {
        $this->indexQuangCao = $indexQuangCao;
        $this->createQuangCao = $createQuangCao;
        $this->editQuangCao = $editQuangCao;
    }

    public function index()
    {
        return $this->indexQuangCao->index();
    }

    public function create(Request $request)
    {
        return $this->createQuangCao->create($request);
    }

    public function loadQuangCaoList()
    {
        return $this->indexQuangCao->loadQuangCaoList();
    }

    public function edit($id)
    {
        return $this->editQuangCao->edit($id);
    }

    public function update(UpdateQuangCaoRequest $request, $id)
    {
        return $this->editQuangCao->update($request, $id);
    }
}
