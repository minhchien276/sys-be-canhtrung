<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ServicesAdmin\QrSuaAdmin\CreateQr;
use App\ServicesAdmin\QrSuaAdmin\IndexQrSua;
use Illuminate\Http\Request;

class QrSuaController extends Controller
{
    private $createQr;
    private $indexQrSua;

    public function __construct(
        CreateQr $createQr,
        IndexQrSua $indexQrSua,
    ) {
        $this->createQr = $createQr;
        $this->indexQrSua = $indexQrSua;
    }

    public function showQrSua()
    {
        return $this->indexQrSua->showQrSua();
    }

    public function create(Request $request)
    {
        return $this->createQr->create($request);
    }

    public function loadListQrSua()
    {
        return $this->indexQrSua->loadListQrSua();
    }
}
