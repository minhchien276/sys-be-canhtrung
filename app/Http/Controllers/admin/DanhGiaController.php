<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSaoRequest;
use App\ServicesAdmin\DanhGiaAdmin\EditSao;
use App\ServicesAdmin\DanhGiaAdmin\IndexDanhGia;

class DanhGiaController extends Controller
{
    private $indexDanhGia;
    private $editSao;

    public function __construct(
        IndexDanhGia $indexDanhGia,
        EditSao $editSao,
    ) {
        $this->indexDanhGia = $indexDanhGia;
        $this->editSao = $editSao;
    }

    public function index()
    {
        return $this->indexDanhGia->index();
    }

    public function showDanhGia($id)
    {
        return $this->indexDanhGia->showDanhGia($id);
    }

    public function editSao($id)
    {
        return $this->editSao->editSao($id);
    }

    public function updateSao(UpdateSaoRequest $request, $id)
    {
        return $this->editSao->updateSao($request, $id);
    }
}
