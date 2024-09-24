<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tailieukichsua;
use App\ServicesAdmin\TaiLieuKichSuaAdmin\CreateTaiLieuKichSua;
use App\ServicesAdmin\TaiLieuKichSuaAdmin\EditTaiLieuKichSua;
use Illuminate\Http\Request;

class TaiLieuKichSuaController extends Controller
{
    private $createTaiLieuKichSua;
    private $editTaiLieuKichSua;

    public function __construct(
        CreateTaiLieuKichSua $createTaiLieuKichSua,
        EditTaiLieuKichSua $editTaiLieuKichSua,
    ) {
        $this->createTaiLieuKichSua = $createTaiLieuKichSua;
        $this->editTaiLieuKichSua = $editTaiLieuKichSua;
    }

    public function index()
    {
        $tailieu = tailieukichsua::all();

        return view('admin.tailieukichsua.index', compact('tailieu'));
    }

    public function create()
    {
        return $this->createTaiLieuKichSua->create();
    }

    public function store(Request $request)
    {
        return $this->createTaiLieuKichSua->store($request);
    }

    public function edit($id)
    {
        return $this->editTaiLieuKichSua->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->editTaiLieuKichSua->update($request, $id);
    }
}
