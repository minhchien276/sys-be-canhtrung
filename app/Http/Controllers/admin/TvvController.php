<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTvvRequest;
use App\Http\Requests\UpdateTvvRequest;
use App\ServicesAdmin\TuVanVienAdmin\CreateTuVanVien;
use App\ServicesAdmin\TuVanVienAdmin\EditTuVanVien;
use App\ServicesAdmin\TuVanVienAdmin\IndexTuVanVien;
use App\ServicesAdmin\TuVanVienAdmin\LoaiTuVanVien;
use App\ServicesAdmin\TuVanVienAdmin\UserTuVanVien;
use Illuminate\Http\Request;

class TvvController extends Controller
{
    private $createTvv;
    private $editTvv;
    private $indexTvv;
    private $loaiTvv;
    private $userTvv;

    public function __construct(
        CreateTuVanVien $createTvv,
        EditTuVanVien $editTvv,
        IndexTuVanVien $indexTvv,
        LoaiTuVanVien $loaiTvv,
        UserTuVanVien $userTvv,
    ) {
        $this->createTvv = $createTvv;
        $this->editTvv = $editTvv;
        $this->indexTvv = $indexTvv;
        $this->loaiTvv = $loaiTvv;
        $this->userTvv = $userTvv;
    }

    public function index()
    {
        return $this->indexTvv->index();
    }

    public function edit($id)
    {
        return $this->editTvv->edit($id);
    }

    public function update(UpdateTvvRequest $request, $id)
    {
        return $this->editTvv->update($request, $id);
    }

    public function create()
    {
        return $this->createTvv->create();
    }

    public function store(CreateTvvRequest $request)
    {
        return $this->createTvv->store($request);
    }

    public function createTypeTvv(Request $request)
    {
        return $this->loaiTvv->createTypeTvv($request);
    }

    public function loadTypeTvvList()
    {
        return $this->loaiTvv->loadTypeTvvList();
    }

    public function deleteTypeTvv($id)
    {
        return $this->loaiTvv->deleteTypeTvv($id);
    }

    public function tvv_nguoidung($id)
    {
        return $this->userTvv->tvv_nguoidung($id);
    }

    public function findUserByPhoneNumber(Request $request)
    {
        return $this->userTvv->findUserByPhoneNumber($request);
    }

    public function AddUser($id)
    {
        return $this->userTvv->AddUser($id);
    }
}
